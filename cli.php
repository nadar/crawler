<?php

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Parsers\PdfParser;
use Nadar\PageCrawler\Stack\ArrayStack;

include 'vendor/autoload.php';


$handler = new DebugHandler();

$crawler = new Crawler('https://www.ak71.ch', new ArrayStack);
$crawler->addParser(new HtmlParser);
$crawler->addHandler($handler);
$crawler->start();

echo "==================" . PHP_EOL;
echo "URLs: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;
echo "peak: " . $handler->memoryPeak() . PHP_EOL;