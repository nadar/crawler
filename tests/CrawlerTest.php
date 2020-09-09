<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\ArrayStorage;

class CrawlerTest extends CrawlerTestCase
{
    public function testRunCrawler()
    {
        $debug = new DebugHandler();

        $crawler = new Crawler('https://luya.io', new ArrayStorage, new LoopRunner);
        $crawler->addParser(new HtmlParser);
        $crawler->addHandler($debug);
        $this->assertEmpty($crawler->setup());

        $this->assertNotEmpty($debug->elapsedTime());
    }
}