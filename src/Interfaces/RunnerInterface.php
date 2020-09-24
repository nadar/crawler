<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;

/**
 * Runner Interface
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface RunnerInterface
{
    public function afterRun(Crawler $crawler);
}
