<?php

namespace Nadar\PageCrawler\Interfaces;

use \Nadar\PageCrawler\Result;

interface HandlerInterface
{
    public function afterRun(Result $result);
}