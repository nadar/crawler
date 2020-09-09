<?php

namespace Nadar\Crawler\Runners;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\RunnerInterface;

class LoopRunner implements RunnerInterface
{
    public function afterRun(Crawler $crawler)
    {
        $crawler->run();
    }
}
