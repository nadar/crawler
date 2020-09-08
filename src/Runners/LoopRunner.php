<?php

namespace Nadar\PageCrawler\Runners;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Interfaces\RunnerInterface;

class LoopRunner implements RunnerInterface
{
    public function afterRun(Crawler $crawler)
    {
        $crawler->run();
    }
}