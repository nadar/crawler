<?php

namespace Nadar\PageCrawler\Handlers;

use Nadar\PageCrawler\Interfaces\HandlerInterface;
use Nadar\PageCrawler\Result;

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

        $mem_usage = memory_get_usage(true);

    
        if ($mem_usage < 1024)
            echo $mem_usage." bytes";
        elseif ($mem_usage < 1048576)
            echo round($mem_usage/1024,2)." kilobytes";
        else
            echo round($mem_usage/1048576,2)." megabytes";
        
            echo PHP_EOL;
    }
}