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

    /**
     * Trim whitespaces also inbetween the content.
     *
     * @param string $string
     * @return string
     */
    public function trim($string)
    {
        return preg_replace('/\s+/', ' ', trim($string));
    }
}
