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
    use ResultPropertiesTrait;

    /**
     * @var Url $url
     */
    public $url;

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
}
