<?php

namespace Nadar\Crawler\Runners;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\RunnerInterface;

/**
 * Loop Runner
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class LoopRunner implements RunnerInterface
{
    /**
     * {@inheritDoc}
     */
    public function afterRun(Crawler $crawler)
    {
        $crawler->run();
    }
}
