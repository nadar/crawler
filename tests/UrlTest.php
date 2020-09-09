<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\Url;

class UrlTest extends CrawlerTestCase
{
    public function testUrlNoramlizer()
    {
        $url = new Url('https://luya.io/foobar?bar=1');
        $this->assertSame('https://luya.io/foobar?bar=1', $url->getNormalized());
    }

    public function testPdfFileName()
    {
        $url = new Url('https://luya.io/files/thisismysuper.pdf');
        $this->assertSame('thisismysuper.pdf', $url->getPathFileName());
    }
}