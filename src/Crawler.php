<?php

namespace Nadar\Crawler;

use Nadar\Crawler\Interfaces\HandlerInterface;
use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Interfaces\RunnerInterface;
use Nadar\Crawler\Interfaces\StorageInterface;

class Crawler
{
    public $concurrentJobs = 30;

    public $baseUrl;

    /**
     * @var string|integer An ID which can be set when the crawler startes in order to re-identifie certain informations in the storage system,
     * for example when running different projects async.
     */
    public $runId;

    /**
     * @var array An array with regular expression (including delimiters) which will be applied to found links so you can
     * filter several urls which should not be followed by the crawler.
     *
     * Examples:
     *
     * ```php
     * 'urlFilterRules' => [
     *     '#.html#i', // filter all links with `.html`
     *     '#/agenda#i', // filter all links which contain the word agenda
     * ],
     * ```
     */
    public $urlFilterRules = [];

    protected $parsers = [];

    protected $handlers = [];

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var RunnerInterface
     */
    protected $runner;

    public function __construct($baseUrl, StorageInterface $storage, RunnerInterface $runner)
    {
        $this->storage = $storage;
        $this->runner  = $runner;
        $this->baseUrl = new Url($baseUrl);
    }

    public function push(Job $job)
    {
        $uniqueUrl = $job->url->getUniqueKey();

        if ($this->isUrlInFilter($job->url, $this->urlFilterRules)) {
            return false;
        }

        if (!$this->storage->isUrlDone($uniqueUrl)) {
            $this->storage->pushQueue(new QueueItem($job->url->getNormalized(), $job->referrerUrl->getNormalized()));
            $this->storage->markUrlAsDone($uniqueUrl);
        }

        unset($uniqueUrl);
    }

    public function isUrlInFilter(Url $url, array $filterRules)
    {
        // filter certain pages
        foreach ($filterRules as $regex) {
            if (preg_match($regex, $url->getNormalized()) === 1) {
                return true;
            }
        }

        return false;
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
        foreach ($this->storage->retrieveQueue($this->concurrentJobs) as $queueItem) {
            $jobs[] = new Job(new Url($queueItem->url), new Url($queueItem->referrerUrl));
        }

        return $jobs;
    }

    public function run()
    {
        $curlRequests = [];
        $multiCurl = curl_multi_init();

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
        } while ($index > 0);

        // get content and remove handles
        foreach ($curlRequests as $queueKey => $ch) {
            $requestResponse = new RequestResponse(curl_multi_getcontent($ch), curl_getinfo($ch, CURLINFO_CONTENT_TYPE));

            $checksum = $requestResponse->getChecksum();
            if (!$this->storage->isChecksumDone($checksum)) {
                $queueJob = $jobs[$queueKey];
                $queueJob->run($requestResponse, $this);
                $this->storage->markChecksumAsDone($checksum);
            }
            unset($checksum);
           
            curl_multi_remove_handle($multiCurl, $ch);
        }

        unset($requestResponse, $queueJob, $queueKey, $jobs, $ch);

        // close
        curl_multi_close($multiCurl);

        // if the queue is not yet empty, re-run the run method
        unset($curlRequests, $multiCurl);

        $this->runner->afterRun($this);
    }

    public function setup()
    {
        $this->storage->onSetup($this);
        $this->push(new Job($this->baseUrl, $this->baseUrl));
    }

    public function end()
    {
        $this->storage->onEnd($this);
    }
}
