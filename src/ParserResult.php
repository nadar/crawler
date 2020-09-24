<?php

namespace Nadar\Crawler;

/**
 * Parser Result
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ParserResult
{
    public $ignore = false;
    
    public $title;

    public $content;

    /**
     * @var array An array with links found on this parsers. The links are not validated whether they are on
     * the curren site or not. Therefore this can also contain external links. The key of the array is the link value the value is 
     * the link content. f.e. <a href="https://luya.io">Go to Website</a> would be ['https://luya.io' => 'Go to Website'].
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
