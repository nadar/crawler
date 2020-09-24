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
     * This method is running after each page has been successfull crawled. 
     *
     * @param Result $result
     */
    public function afterRun(Result $result);

    /**
     * When the crawler is finishing the whole process.
     *
     * @param Crawler $crawler
     */
    public function onEnd(Crawler $crawler);

    /**
     * Before the crawler starts
     *
     * @param Crawler $crawler
     */
    public function onSetup(Crawler $crawler);
}
