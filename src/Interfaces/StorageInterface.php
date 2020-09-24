<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\QueueItem;

/**
 * Runtime Stack
 *
 * The runtime stack is a storage system which is required when the parsers run in order to determine whether an
 * url is already parsed or not.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface StorageInterface
{
    public function onSetup(Crawler $crawler);

    public function onEnd(Crawler $crawler);

    public function isUrlDone($url): bool;

    public function markUrlAsDone($url);

    public function isChecksumDone($checksum): bool;

    public function markChecksumAsDone($checksum);

    public function pushQueue(QueueItem $queueItem);

    /**
     * Must return an array with QueueItem objects and the retrieved items MUST be deleted from the queue!
     *
     * + Must return an array with QueueItems
     * + The runtime stack integrator retrieveQueue() must take care of empting the queue
     * + empty if the queue is empty, an empty array will be returned. so the crawler knows to finish the crawler process.
     *
     * @param integer $amount
     * @return array
     */
    public function retrieveQueue($amount): array;
}
