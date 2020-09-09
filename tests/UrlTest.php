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
        $this->assertSame('pdf', $url->getPathExtension());
        $this->assertSame('https://luya.io/files/thisismysuper.pdf', $url->getNormalized());
        $this->assertSame('luya.iofiles/thisismysuper.pdf', $url->getUniqueKey());
        $this->assertSame('luya.io', $url->getHost());
        $this->assertSame('/files/thisismysuper.pdf', $url->getPath());
        $this->assertSame('thisismysuper.pdf', $url->getPathFileName());
        $this->assertSame(false, $url->getQuery());
        $this->assertSame('https', $url->getScheme());
        $this->assertSame(true, $url->isValid());
        $this->assertTrue($url->sameHost(new Url('https://luya.io')));
        $this->assertFalse($url->sameHost(new Url('https://nadar.io')));
    }

    public function testMerge()
    {
        $a = new Url('/foobar');
        $b = new Url('https://nadar.io/barfoo');
        

        $this->assertSame('nadar.io', $a->merge($b)->getHost());
        $this->assertSame('https', $a->merge($b)->getScheme());

        $this->assertSame('nadar.io', $b->merge($a)->getHost()); // nothing will happen as host exists
        $this->assertSame('https', $b->merge($a)->getScheme()); // nothing will happen as scheme exists
    }
}
