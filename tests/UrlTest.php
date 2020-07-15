<?php

namespace Nadar\PageCrawler\Tests;

use Nadar\PageCrawler\Url;

class UrlTest extends PageCrawlerTestCase
{
    public function testUrlNoramlizer()
    {
        $url = new Url('https://luya.io/foobar?bar=1');
        $this->assertSame('https://luya.io/foobar?bar=1', $url->getNormalized());
    }
}