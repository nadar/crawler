<?php

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Interfaces\HandlerInterface;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Result;

include 'vendor/autoload.php';

class MyHandler implements HandlerInterface
{
    public $counter = 0;

    public $start;

    public function __construct()
    {
        $this->start = microtime(true);
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

$handler = new DebugHandler();

$crawler = new Crawler('https://luya.io');
$crawler->addParser(new HtmlParser);
$crawler->addHandler($handler);
$crawler->run();

echo "==================" . PHP_EOL;
echo "sites: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;