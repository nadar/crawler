<?php

namespace Nadar\PageCrawler;

class JobResult
{
    public $ignore = false;
    
    public $title;

    public $content;

    public $followUrls = [];

    public $language;

    public $keywords;

    public $description;

    public $group;
}