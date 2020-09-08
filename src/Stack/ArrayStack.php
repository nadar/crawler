<?php

namespace Nadar\PageCrawler\Stack;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Interfaces\RuntimeStackInterface;

class ArrayStack implements RuntimeStackInterface
{
    //protected $queue = [];

    protected $done = [];

    protected $checksums = [];

    public function onStart(Crawler $crawler)
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
}