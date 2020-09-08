<?php

namespace Nadar\PageCrawler\Tests;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Handlers\DebugHandler;
use Nadar\PageCrawler\Runners\LoopRunner;
use Nadar\PageCrawler\Storage\ArrayStorage;

class CrawlerTest extends PageCrawlerTestCase
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