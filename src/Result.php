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

    public $parser;

    public $checksum;

    // Response information from the Parser

    /**
     * @var Url $url
     */
    public $url;

    public $language;

    public $title;

    public $content;

    public $keywords;

    public $description;

    public $group;
}
