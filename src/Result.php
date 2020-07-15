<?php

namespace Nadar\PageCrawler;

class Result
{
    // assigned by job

    public $refererUrl;

    public $contentType;

    public $format;

    // custom


    
    public $url;

    public $title;

    public $content;

    public $followUrls = [];

    public $language;

    public $keywords;

    public $description;

    public $group;
}