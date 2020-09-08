<?php

namespace Nadar\PageCrawler\Storage;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Interfaces\StorageInterface;
use Nadar\PageCrawler\QueueItem;

class ArrayStorage implements StorageInterface
{
    protected $done = [];

    protected $checksums = [];

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

    public function isUrlDone($url)
    {
        return in_array($url, $this->done, true);
    }

    public function markUrlAsDone($url)
    {
        $this->done[] = $url;
    }

    public function isChecksumDone($checksum)
    {
        return in_array($checksum, $this->checksums);
    }

    public function markChecksumAsDone($checksum)
    {
        $this->checksums[] = $checksum;
    }

    /////////// QUEUE

    protected $queue = [];

    public function pushQueue(QueueItem $queueItem)
    {
        $this->queue[] = $queueItem;
    }

    public function retrieveQueue($amount): array
    {
        return array_splice($this->queue, 0, $amount);
    }
}