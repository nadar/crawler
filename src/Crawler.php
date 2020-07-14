<?php

namespace Nadar\PageCrawler;

class Crawler
{
    public function __construct($url)
    {
        
    }

    public $queue = [];

    public $formats = []; // textplain => Html::class
}