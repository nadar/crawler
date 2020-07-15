<?php

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Interfaces\HandlerInterface;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Result;

include 'vendor/autoload.php';


$handler = new DebugHandler();

$crawler = new Crawler('https://vertikal.net');
$crawler->addParser(new HtmlParser);
$crawler->addHandler($handler);
$crawler->run();

echo "==================" . PHP_EOL;
echo "sites: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;