<?php

namespace Nadar\PageCrawler\Interfaces;

use Nadar\PageCrawler\Crawler;

interface RunnerInterface
{
    public function afterRun(Crawler $crawler);
}