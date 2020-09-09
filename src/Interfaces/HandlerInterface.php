<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;
use \Nadar\Crawler\Result;

interface HandlerInterface
{
    public function afterRun(Result $result);

    public function onEnd(Crawler $crawler);

    public function onSetup(Crawler $crawler);
}
