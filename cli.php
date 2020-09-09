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

$handler->summary();
