<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\RequestResponse;

class RequestResponseTest extends CrawlerTestCase
{
    public function testRequestResponseMethods()
    {
        $r = new RequestResponse('foobar', 'text/html; charset=UTF-8');

        $this->assertSame('foobar', $r->getContent());
        $this->assertSame('3858f62230ac3c915f300c664312c63f', $r->getChecksum());
        $this->assertSame('text/html', $r->getContentType());
    }
}