<?php

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Parsers\PdfParser;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\ArrayStorage;
use Nadar\Crawler\Storage\FileStorage;

include 'vendor/autoload.php';


$handler = new DebugHandler();

$crawler = new Crawler('https://demo.luya.io/', new FileStorage(dirname(__FILE__) . '/runtime'), new LoopRunner);
$crawler->addParser(new HtmlParser);
$crawler->addParser(new PdfParser);
$crawler->addHandler($handler);
$crawler->setup();
$crawler->run();

echo "==================" . PHP_EOL;
echo "URLs: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;
echo "memory peak: " . $handler->memoryPeak() . PHP_EOL;
echo "memory: " . $handler->memory() . PHP_EOL; 