<?php

namespace Nadar\Crawler;

class Result
{
    // assigned by job

    /**
     * @var Url $url
     */
    public $refererUrl;

    public $contentType;

    public $format;

    // custom


    /**
     * @var Url $url
     */
    public $url;

    public $title;

    public $content;

    public $followUrls = [];

    public $language;

    public $keywords;

    public $description;

    public $group;
}
