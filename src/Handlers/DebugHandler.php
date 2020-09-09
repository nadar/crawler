<?php

namespace Nadar\Crawler\Handlers;

use Nadar\Crawler\Interfaces\HandlerInterface;
use Nadar\Crawler\Result;

class DebugHandler implements HandlerInterface
{
    public $counter = 0;

    public $start;

    public function __construct()
    {
        $this->start = microtime(true);
    }

    public function elapsedTime()
    {
        return microtime(true) - $this->start;
    }

    public function afterRun(Result $result)
    {
        $this->counter++;

        echo $result->url->getNormalized() . " | " . $result->title . " | ";

        echo $this->readableMemory(memory_get_usage(true));

        echo PHP_EOL;
    }

    public function memoryPeak()
    {
        return $this->readableMemory(memory_get_peak_usage(true));
    }

    private function readableMemory($memory)
    {
        if ($memory < 1024) {

            return $memory." bytes";
        } elseif ($memory < 1048576) {

            return round($memory/1024,2)." kilobytes";
        }
        
        return round($memory/1048576,2)." megabytes";
    }
}