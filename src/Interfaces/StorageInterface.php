<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\QueueItem;

/**
 * Runtime Stack
 *
 * The runtime storage is a system which is required when the parsers crawling in order to determine whether an
 * url is already parsed or not. It also stores checksum and the current queue status.
 *
 * Keep in mind this, data is only temporary required. Therefore before and after crawler run this data must be wiped
 * and is only valid for a **single crawler run**.
 *
 * To cleanup and/or initialize the storage system `onSetup(Crawler $crawler)` and `onEnd(Crawler $crawler)` should be used.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface StorageInterface extends CrawlerCycleInterface
{
    /**
     * Checks whether the given url is already done (in the index of the storage system) or not
     *
     * @param string $url
     * @return boolean
     */
    public function isUrlDone($url): bool;

    /**
     * Mark an URL as done inside the storage
     *
     * @param string $url
     */
    public function markUrlAsDone($url);

    /**
     * Checks wehther the given checksum is already done (in the index of the storage system) or not
     *
     * @param string $checksum The checksum is an md5 hash
     * @return boolean
     */
    public function isChecksumDone($checksum): bool;

    /**
     * Mark a given checksum as done inside the storage system
     *
     * @param string $checksum The checksum is an md5 hash
     */
    public function markChecksumAsDone($checksum);

    /**
     * Push a new Queue Item into the storage system
     *
     * @param QueueItem $queueItem
     */
    public function pushQueue(QueueItem $queueItem);

    /**
     * Must return an array with QueueItem objects and the retrieved items MUST be deleted from the storaged queue!
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
