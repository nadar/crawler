<?php

namespace Nadar\PageCrawler\Tests;

use Nadar\PageCrawler\Crawler;
use Nadar\PageCrawler\Formats\Html;

class CrawlerTest extends PageCrawlerTestCase
{
    public function testRunCrawler()
    {
        $crawler = new Crawler('https://kunstmuseumbasel.ch');
        $crawler->addFormat(new Html);
        $this->assertEmpty($crawler->run());
    }
}