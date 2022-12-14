<?php

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\FileStorage;

include 'vendor/autoload.php';

$handler = new DebugHandler();

$storage = new FileStorage(dirname(__FILE__) . '/runtime');
//$storage = new ArrayStorage;

$crawler = new Crawler('https://luya.io/', $storage, new LoopRunner());
$crawler->concurrentJobs = 30;
$crawler->addParser(new HtmlParser());
//$crawler->addParser(new PdfParser);
$crawler->addHandler($handler);
$crawler->setup();
$crawler->run();
