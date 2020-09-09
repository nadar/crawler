<?php

namespace Nadar\Crawler;

class JobResult
{
    public $ignore = false;
    
    public $title;

    public $content;

    public $followUrls = [];

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
