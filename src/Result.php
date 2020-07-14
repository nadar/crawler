<?php

namespace Nadar\PageCrawler;

class Job
{
    public $url;

    public $title;

    public $content;

    public $followUpUrls = [];

    public $type; // pdf, html, text ....., image
}