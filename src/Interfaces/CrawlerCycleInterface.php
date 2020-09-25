<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;

/**
 * Crawler Cycle Interface
 * 
 * This interfaces holds the methods which are processed on each Crawler execution.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface CrawlerCycleInterface
{
    /**
     * Before the crawler starts, when setting up the crawler.
     * 
     * At this poin only the storage engine is ready.
     * 
     * > its very commony to cleanup the building index at this stage
     *
     * @param Crawler $crawler
     */
    public function onSetup(Crawler $crawler);

    /**
     * When the crawler is finishing the whole process.
     * 
     * > its very common to synchronize now the building index into the actuall index.
     *
     * @param Crawler $crawler
     */
    public function onEnd(Crawler $crawler);
}