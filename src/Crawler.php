<?php

namespace Nadar\PageCrawler;

class Crawler
{
    protected $baseUrl;

    protected $queue = [];

    protected $handlers = [];

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->push(new Job($this, new Uri($this->baseUrl)));
    }

    public function push(Job $job)
    {
        $this->queue[] = $job;
    }

    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function run()
    {
        foreach ($this->queue as $queueJob) {
            
        }
    }
}