<?php

namespace Nadar\PageCrawler\Interfaces;

use Nadar\PageCrawler\Crawler;

/**
 * Runtime Stack
 * 
 * The runtime stack is a storage system which is required when the parsers run in order to determine whether an 
 * url is already parsed or not.
 */
interface RuntimeStackInterface
{
    public function onStart(Crawler $crawler);

    public function onEnd(Crawler $crawler);

    public function isUrlDone($url);

    public function markUrlAsDone($url);

    public function isChecksumDone($checksum);

    public function markChecksumAsDone($checksum);
}