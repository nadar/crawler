<?php

namespace Nadar\Crawler;

use Nadar\Crawler\Interfaces\ParserInterface;

class Result
{
    // assigned by job

    /**
     * @var Url $url
     */
    public $refererUrl;

    public $contentType;

    /**
     * @var ParserInterface
     */
    public $parser;

    /**
     * @var ParserResult
     */
    public $parserResult;

    public $checksum;

    // Response information from the Parser

    /**
     * @var Url $url
     */
    public $url;

    /**
     * @var string The language from html language attribute info, if available.
     */
    public $language;

    public $title;

    public $content;

    public $keywords;

    public $description;

    public $group;
}
