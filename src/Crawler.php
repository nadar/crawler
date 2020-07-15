<?php

namespace Nadar\PageCrawler;

use Nadar\PageCrawler\Interfaces\HandlerInterface;
use Nadar\PageCrawler\Interfaces\ParserInterface;

class Crawler
{
    public $concurrentJobs = 30;

    public $baseUrl;

    protected $done = [];

    protected $queue = [];

    protected $handlers = [];

    protected $parsers = [];

    protected $checksums = [];

    public function __construct($baseUrl)
    {
        $this->baseUrl = new Url($baseUrl);
        $this->push(new Job($this,$this->baseUrl, $this->baseUrl));
    }

    public function push(Job $job)
    {
        $uniqueUrl = $job->url->getUniqueKey();

        if (!in_array($uniqueUrl, $this->done, true)) {
            $this->queue[] = $job;
            $this->done[] = $uniqueUrl;
        }

        unset($uniqueUrl);
    }

    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function getHandlers()
    {
        return $this->handlers;
    }

    public function addParser(ParserInterface $parser)
    {
        $this->parsers[] = $parser;
    }

    public function getParsers()
    {
        return $this->parsers;
    }

    public function run()
    {
        $curlRequests = [];
        $multiCurl = curl_multi_init();

        $jobs = array_splice($this->queue, 0, $this->concurrentJobs);

        foreach ($jobs as $queueKey => $queueJob) {
            if ($queueJob->validate()) {
                $curlRequests[$queueKey] = $queueJob->generateCurl();
                curl_multi_add_handle($multiCurl, $curlRequests[$queueKey]);
            } else {
                unset($this->queue[$queueKey]);
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

            if (!in_array($requestResponse->getChecksum(), $this->checksums, true)) {
                $queueJob = $jobs[$queueKey];
                $queueJob->run($requestResponse);
                $this->checksums[] = $requestResponse->getChecksum();
            } else {
                echo "ExISISISI!!!";
            }
           
            curl_multi_remove_handle($multiCurl, $ch);
        }


        unset($requestResponse, $queueJob, $queueKey, $jobs, $ch);
        

        // close
        curl_multi_close($multiCurl);

        // if the queue is not yet empty, re-run the run method
        unset($curlRequests, $multiCurl);

        if (!empty($this->queue)) {
            $this->run();
        } else {
            $this->end();
        }
    }

    public function end()
    {
    }
}