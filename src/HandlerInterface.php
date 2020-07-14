<?php

namespace Nadar\PageCrawler;

interface HandlerInterface
{
    public function beforeRun();

    public function afterRun(\nadar\PageCrawler\Result $result);
}