<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;

interface RunnerInterface
{
    public function afterRun(Crawler $crawler);
}
