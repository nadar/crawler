<?php

namespace Nadar\PageCrawler\Tests;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Parsers\HtmlParser;
use Nadar\PageCrawler\Handlers\DebugHandler;

class CrawlerTest extends PageCrawlerTestCase
{
    public function testRunCrawler()
    {
        $debug = new DebugHandler();

        $crawler = new Crawler('https://luya.io');
        $crawler->addParser(new HtmlParser);
        $crawler->addHandler($debug);
        $this->assertEmpty($crawler->run());

        $this->assertNotEmpty($debug->elapsedTime());
    }
}