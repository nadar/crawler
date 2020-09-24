<?php

namespace Nadar\Crawler\Storage;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\StorageInterface;
use Nadar\Crawler\QueueItem;

/**
 * Array Storage
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class ArrayStorage implements StorageInterface
{
    protected $done = [];

    protected $checksums = [];

    protected $queue = [];

    public function onSetup(Crawler $crawler)
    {
        $this->done = [];
        $this->checksums = [];
    }

    public function onEnd(Crawler $crawler)
    {
        $this->done = [];
        $this->checksums = [];
    }

    public function isUrlDone($url) : bool
    {
        return in_array($url, $this->done, true);
    }

    public function markUrlAsDone($url)
    {
        $this->done[] = $url;
    }

    public function isChecksumDone($checksum) : bool
    {
        return in_array($checksum, $this->checksums);
    }

    public function markChecksumAsDone($checksum)
    {
        $this->checksums[] = $checksum;
    }

    public function pushQueue(QueueItem $queueItem)
    {
        $this->queue[] = $queueItem;
    }

    public function retrieveQueue($amount): array
    {
        return array_splice($this->queue, 0, $amount);
    }
}
