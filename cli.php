<?php

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Runners\LoopRunner;
use Nadar\PageCrawler\Storage\ArrayStorage;

include 'vendor/autoload.php';


$handler = new DebugHandler();

$crawler = new Crawler('https://www.ak71.ch', new ArrayStorage, new LoopRunner);
$crawler->addParser(new HtmlParser);
$crawler->addHandler($handler);
$crawler->setup();
$crawler->run();

echo "==================" . PHP_EOL;
echo "URLs: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;
echo "peak: " . $handler->memoryPeak() . PHP_EOL;