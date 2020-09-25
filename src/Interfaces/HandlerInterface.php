<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;
use \Nadar\Crawler\Result;

/**
 * Handler Interface
 * 
 * The Handler is the entity which generates your index or whatever is your use case.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface HandlerInterface
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
     * This method is running after each page has been successfull crawled.
     * 
     * The result contains the result from a successfull crawl of ANY parsers. This means
     * its possible, for whatever reason, that two parsers might return the same url, maybe with
     * different content.
     *
     * @param Result $result
     */
    public function afterRun(Result $result);

    /**
     * When the crawler is finishing the whole process.
     * 
     * > its very common to synchronize now the building index into the actuall index.
     *
     * @param Crawler $crawler
     */
    public function onEnd(Crawler $crawler);
}
