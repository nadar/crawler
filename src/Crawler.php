<?php

namespace Nadar\PageCrawler;

use Nadar\PageCrawler\Interfaces\HandlerInterface;
use Nadar\PageCrawler\Interfaces\ParserInterface;
use Nadar\PageCrawler\Interfaces\RuntimeStackInterface;

class Crawler
{
    public $concurrentJobs = 30;

    public $baseUrl;

    /**
     * @var array An array with regular expression (including delimiters) which will be applied to found links so you can
     * filter several urls which should not be followed by the crawler.
     *
     * Examples:
     *
     * ```php
     * 'filterRegex' => [
     *     '/\.\//i',           // filter all links with a dot inside
     *     '/agenda\//i',       // filter all pages who contains "agenda/"
     * ],
     * ```
     */
    public $urlFilter = [];

    protected $parsers = [];

    protected $handlers = [];

    /**
     * @var RuntimeStackInterface
     */
    protected $runtimeStack;

    // stack

    protected $done = [];

    protected $queue = [];

    protected $checksums = [];

    public function __construct($baseUrl, RuntimeStackInterface $runtimeSack)
    {
        $this->runtimeStack = $runtimeSack;
        $this->baseUrl = new Url($baseUrl);
    }

    public function push(Job $job)
    {
        $uniqueUrl = $job->url->getUniqueKey();

        // filter certain pages
        foreach ($this->urlFilter as $regex) {
            if (preg_match($regex, $job->url->getNormalized()) === 1) {
                return false;
            }
        }

        if (!$this->runtimeStack->isUrlDone($uniqueUrl)) {
            $this->runtimeStack->pushQueue(new QueueItem($job->url->getNormalized(), $job->referrerUrl->getNormalized()));
            //$this->queue[] = $job;
            $this->runtimeStack->markUrlAsDone($uniqueUrl);
        }

        unset($uniqueUrl);
    }

    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Undocumented function
     *
     * @return HandlerInterface[]
     */
    public function getHandlers() : array
    {
        return $this->handlers;
    }

    public function addParser(ParserInterface $parser)
    {
        $this->parsers[] = $parser;
    }

    /**
     * Undocumented function
     *
     * @return ParserInterface[]
     */
    public function getParsers() : array
    {
        return $this->parsers;
    }

    public function retrieveQueueJobs()
    {
        $jobs = [];
        /** @var QueueItem $queueItem */
        foreach ($this->runtimeStack->retrieveQueue($this->concurrentJobs) as $queueItem) {
            $jobs[] = new Job(new Url($queueItem->url), new Url($queueItem->referrerUrl));
        }

        return $jobs;
    }

    public function run()
    {
        $curlRequests = [];
        $multiCurl = curl_multi_init();

        //$jobs = array_splice($this->queue, 0, $this->concurrentJobs);
        $jobs = $this->retrieveQueueJobs();

        if (empty($jobs)) {
            return $this->end();
        }

        foreach ($jobs as $queueKey => $queueJob) {
            if ($queueJob->validate($this)) {
                $curlRequests[$queueKey] = $queueJob->generateCurl();
                curl_multi_add_handle($multiCurl, $curlRequests[$queueKey]);
            }
        }

        unset($queueJob, $queueKey);

        $index = null;
        do {
            curl_multi_exec($multiCurl, $index);
        } while($index > 0);

        // get content and remove handles
        foreach ($curlRequests as $queueKey => $ch) {

            $requestResponse = new RequestResponse(curl_multi_getcontent($ch), curl_getinfo($ch, CURLINFO_CONTENT_TYPE));

            $checksum = $requestResponse->getChecksum();
            if (!$this->runtimeStack->isChecksumDone($checksum)) {
                $queueJob = $jobs[$queueKey];
                $queueJob->run($requestResponse, $this);
                $this->runtimeStack->markChecksumAsDone($checksum);
            }
            unset($checksum);
           
            curl_multi_remove_handle($multiCurl, $ch);
        }

        unset($requestResponse, $queueJob, $queueKey, $jobs, $ch);

        // close
        curl_multi_close($multiCurl);

        // if the queue is not yet empty, re-run the run method
        unset($curlRequests, $multiCurl);

        $this->run();
    }

    public function start()
    {
        $this->runtimeStack->onStart($this);
        $this->push(new Job($this->baseUrl, $this->baseUrl));
        $this->run();
    }

    public function end()
    {
        $this->runtimeStack->onEnd($this);
    }
}