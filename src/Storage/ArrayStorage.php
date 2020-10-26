<?php

namespace Nadar\Crawler\Storage;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\StorageInterface;
use Nadar\Crawler\QueueItem;

/**
 * Array Storage
 *
 * Store the current crawler process queue inside the memory (array).
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ArrayStorage implements StorageInterface
{
    protected $done = [];

    protected $checksums = [];

    protected $queue = [];

    /**
     * {@inheritDoc}
     */
    public function onSetup(Crawler $crawler)
    {
        $this->done = [];
        $this->checksums = [];
    }

    /**
     * {@inheritDoc}
     */
    public function onEnd(Crawler $crawler)
    {
        $this->done = [];
        $this->checksums = [];
    }

    /**
     * {@inheritDoc}
     */
    public function isUrlDone($url) : bool
    {
        return in_array($url, $this->done, true);
    }

    /**
     * {@inheritDoc}
     */
    public function markUrlAsDone($url)
    {
        $this->done[] = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function isChecksumDone($checksum) : bool
    {
        return in_array($checksum, $this->checksums);
    }

    /**
     * {@inheritDoc}
     */
    public function markChecksumAsDone($checksum)
    {
        $this->checksums[] = $checksum;
    }

    /**
     * {@inheritDoc}
     */
    public function pushQueue(QueueItem $queueItem)
    {
        $this->queue[] = $queueItem;
    }

    /**
     * {@inheritDoc}
     */
    public function retrieveQueue($amount): array
    {
        return array_splice($this->queue, 0, $amount);
    }
}
