<?php

namespace Nadar\Crawler;

use Nadar\Crawler\Interfaces\ParserInterface;

/**
 * Result
 * 
 * Represents the Result from a crawl job
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class Result
{
    // Assigned by Job

    /**
     * @var Url $url
     */
    public $refererUrl;

    /**
     * @var string The content type as string, f.e. `application/pdf` or `text/html`.
     */
    public $contentType;

    /**
     * @var ParserInterface
     */
    public $parser;

    /**
     * @var ParserResult
     */
    public $parserResult;

    /**
     * @var string The checksum is generated from the request response content.
     */
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

    /**
     * @var string The title
     */
    public $title;

    /**
     * @var string The content
     */
    public $content;

    /**
     * @var string A list of keywords, not exploded in raw format from meta informations (or any other information location).
     */
    public $keywords;

    /**
     * @var string A description of the page, from meta description or any other information location
     */
    public $description;

    /**
     * @var string A group identifier from [CRAWL_GROUP]info[/CRAWL_GROUP] tag
     */
    public $group;
}
