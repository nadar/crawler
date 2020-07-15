<?php

namespace Nadar\PageCrawler;

class Crawler
{
    public $concurrentJobs = 10;

    public $baseUrl;

    protected $done = [];

    protected $queue = [];

    protected $handlers = [];

    protected $formats = [];

    public function __construct($baseUrl)
    {
        $this->baseUrl = new Url($baseUrl);
        $this->push(new Job($this,$this->baseUrl, $this->baseUrl));
    }

    public function push(Job $job)
    {
        $url = $job->url->getNormalized();

        if (!in_array($url, $this->done, true)) {
            $this->queue[] = $job;
            $this->done[] = $url;
        }
    }

    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function getHandlers()
    {
        return $this->handlers;
    }

    public function addFormat(FormatInterface $format)
    {
        $this->formats[] = $format;
    }

    public function getFormats()
    {
        return $this->formats;
    }

    public function run()
    {
        $curlRequests = [];
        $multiCurl = curl_multi_init();

        foreach (array_slice($this->queue, 0, $this->concurrentJobs) as $queueKey => $queueJob) {
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

            $queueJob = $this->queue[$queueKey];
            $queueJob->run($requestResponse);
            curl_multi_remove_handle($multiCurl, $ch);

            /*
            echo $queueKey . ' - ' . $queueJob->url->getNormalized() . ' | ';
            */
            
            unset ($this->queue[$queueKey]);
        }


        unset($requestResponse, $queueJob, $queueKey);
        

        // close
        curl_multi_close($multiCurl);

        // if the queue is not yet empty, re-run the run method
        unset($curlRequests, $multiCurl);

        if (!empty($this->queue)) {
            $this->queue = array_values($this->queue);
            $this->run();
        } else {
            $this->end();
        }
    }

    public function end()
    {
    }
}