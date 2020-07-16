<?php

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Parsers\PdfParser;

include 'vendor/autoload.php';


$handler = new DebugHandler();

$crawler = new Crawler('https://zephir.ch');
$crawler->addParser(new HtmlParser);
$crawler->addParser(new PdfParser);
$crawler->addHandler($handler);
$crawler->run();

echo "==================" . PHP_EOL;
echo "URLs: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;
echo "peak: " . $handler->memoryPeak() . PHP_EOL;