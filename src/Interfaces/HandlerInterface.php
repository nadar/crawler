<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;
use \Nadar\Crawler\Result;

/**
 * Handler Interface
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface HandlerInterface
{
    public function afterRun(Result $result);

    public function onEnd(Crawler $crawler);

    public function onSetup(Crawler $crawler);
}
