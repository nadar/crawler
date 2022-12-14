<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;

/**
 * Runner Interface
 *
 * The Runner determines the what should happen after a successful crawler run iteration.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface RunnerInterface
{
    /**
     * This method is invoken right after a succsfull run iteration of the crawler.
     *
     * @param Crawler $crawler
     */
    public function afterRun(Crawler $crawler);
}
