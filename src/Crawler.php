<?php

namespace Nadar\Crawler;

use Nadar\Crawler\Interfaces\HandlerInterface;
use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Interfaces\RunnerInterface;
use Nadar\Crawler\Interfaces\StorageInterface;

/**
 * Crawler
 *
 * The main object holding the process informations.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class Crawler
{
    /**
     * Th@var integer The number of concurrent curl download requests, this can increase memory.
     */
    public $concurrentJobs = 30;

    /**
     * @var integer The download limit in Bytes. Every response which is higher then the above value will be skipped on not the passed to the parsers. (1000000 Bytes = 1 Mb)
     * This can be helpfull that parsers won't run into large memory leaks. If the value false is provided, the limit is disabeld.
     * @since 1.2.0
     */
    public $maxSize = 1000000;

    /**
     * @var Url Contains the URL object with the base URL. Urls which are not matching the base url will not be crawled or added to the results page.
     */
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

    /**
     * @var ParserInterface[] An array containing all parser objects
     */
    protected $parsers = [];

    /**
     * @var HandlerInterface[] An array containing all handler objects
     */
    protected $handlers = [];

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var RunnerInterface
     */
    protected $runner;

    /**
     * Constructor
     *
     * @param string $baseUrl The base url f.e. `https://luya.io`
     * @param StorageInterface $storage
     * @param RunnerInterface $runner
     */
    public function __construct($baseUrl, StorageInterface $storage, RunnerInterface $runner)
    {
        $this->storage = $storage;
        $this->runner  = $runner;
        $this->baseUrl = new Url($baseUrl);
    }

    /**
     * Push a new Job into the Crawler Queue
     *
     * @param Job $job
     */
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

    /**
     * Check whether an URL is in the list of filters or not
     *
     * @param Url $url
     * @param array $filterRules
     * @return boolean
     */
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

    /**
     * Add a Handler to the Crawler
     *
     * @param HandlerInterface $handler
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Get all registered handlers.
     *
     * @return HandlerInterface[]
     * @see {{addHandler()}}
     */
    public function getHandlers() : array
    {
        return $this->handlers;
    }

    /**
     * Add a new Parser to the Crawler
     *
     * @param ParserInterface $parser
     */
    public function addParser(ParserInterface $parser)
    {
        $this->parsers[] = $parser;
    }

    /**
     * Get all registered parsers
     *
     * @return ParserInterface[]
     * @see {{addParser()}}
     */
    public function getParsers() : array
    {
        return $this->parsers;
    }

    /**
     * Get all upcoming jobs from the queue and parse them into a Job object
     *
     * @return Job[] An array with Job objects
     */
    protected function retrieveQueueJobs()
    {
        $jobs = [];
        /** @var QueueItem $queueItem */
        foreach ($this->storage->retrieveQueue($this->concurrentJobs) as $queueItem) {
            $jobs[] = new Job(new Url($queueItem->url), new Url($queueItem->referrerUrl));
        }

        return $jobs;
    }
    
    /**
     * Setup the Crawler
     */
    public function setup()
    {
        $this->storage->onSetup($this);
        foreach ($this->getHandlers() as $handler) {
            $handler->onSetup($this);
        }
        $this->push(new Job($this->baseUrl, $this->baseUrl));
    }

    /**
     * Run the crawler cycle
     */
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

            if ($this->maxSize && curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD) > $this->maxSize) {
                curl_multi_remove_handle($multiCurl, $ch);
                unset($ch);
            }

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

    /**
     * Is triggered when the crawler ends
     */
    protected function end()
    {
        $this->storage->onEnd($this);
        foreach ($this->getHandlers() as $handler) {
            $handler->onEnd($this);
        }
    }
}
