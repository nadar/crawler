<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Result;

/**
 * Handler Interface
 *
 * The Handler is the entity which generates your index or whatever is your use case.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface HandlerInterface extends CrawlerCycleInterface
{
    /**
     * This method is running after each page has been successful crawled.
     *
     * The result contains the result from a successful crawl of ANY parsers. This means
     * its possible, for whatever reason, that two parsers might return the same url, maybe with
     * different content.
     *
     * @param Result $result
     */
    public function afterRun(Result $result);
}
