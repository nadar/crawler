<?php

namespace Nadar\Crawler;

/**
 * Stringable Properties which are Shared between ParserResult and Result
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
trait ResultPropertiesTrait
{
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
