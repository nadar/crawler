<?php

namespace Nadar\Crawler;

class ParserResult
{
    public $ignore = false;
    
    public $title;

    public $content;

    /**
     * @var array An array with links found on this parsers. The links are not validated whether they are on
     * the curren site or not. Therefore this can also contain external links.
     */
    public $links = [];

    public $language;

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
