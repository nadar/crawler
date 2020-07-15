<?php

namespace Nadar\PageCrawler\Interfaces;

interface HandlerInterface
{
    public function afterRun(\Nadar\PageCrawler\Result $result);
}