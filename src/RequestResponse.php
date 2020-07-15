<?php

namespace Nadar\PageCrawler;

class RequestResponse
{
    protected $content;
    protected $contentType;

    public function __construct($content, $contentType)
    {
        $this->content = $content;
        $this->contentType = trim($contentType);    
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getContentType()
    {
        return current(explode(";", $this->contentType));
    }
}