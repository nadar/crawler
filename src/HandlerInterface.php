<?php

namespace Nadar\PageCrawler;

interface HandlerInterface
{
    public function afterRun(\Nadar\PageCrawler\Result $result);
}