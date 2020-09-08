<?php

namespace Nadar\PageCrawler;

class QueueItem
{
    public $url;

    public $referrerUrl;

    public function __construct($url, $referrerUrl)
    {
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;    
    }
}