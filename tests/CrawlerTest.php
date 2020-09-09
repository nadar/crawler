<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\ArrayStorage;
use Nadar\Crawler\Url;

class CrawlerTest extends CrawlerTestCase
{
    public function testRunCrawler()
    {
        $debug = new DebugHandler();

        $crawler = new Crawler('https://luya.io', new ArrayStorage, new LoopRunner);
        $crawler->addParser(new HtmlParser);
        $crawler->addHandler($debug);
        $this->assertEmpty($crawler->setup());
        $this->assertEmpty($crawler->run());
        $this->assertNotEmpty($debug->elapsedTime());
    }

    public function testFilterUrl()
    {
        $crawler = new Crawler('https://luya.io', new ArrayStorage, new LoopRunner);

        $this->assertTrue($crawler->isUrlInFilter(new Url('https://luya.io'), ["/luya.io/"]));
        $this->assertFalse($crawler->isUrlInFilter(new Url('https://luya.io'), ["/example.com/"]));
        $this->assertTrue($crawler->isUrlInFilter(new Url('https://luya.io/test.html'), ["#.html#i"]));
        $this->assertTrue($crawler->isUrlInFilter(new Url('https://luya.io/test/agenda'), ["#/agenda#i"]));
        $this->assertFalse($crawler->isUrlInFilter(new Url('https://test/the-agenda'), ["#/agenda#i"]));
    }
}
