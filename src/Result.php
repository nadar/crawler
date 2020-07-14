<?php

namespace Nadar\PageCrawler;

class Result
{
    public $url;

    public $uri;

    public $title;

    public $contentType;

    public $followUris = [];

    public $type; // pdf, html, text ....., image

    public $language;

    public $keywords;

    public $description;

    public $group;
}