<?php

namespace Nadar\Crawler\Tests\Handlers;

use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Tests\CrawlerTestCase;

class DebugHandlerTeste extends CrawlerTestCase
{
    public function testReadableMemory()
    {
        $debug = new DebugHandler();
        $this->assertSame('1000 bytes', $debug->readableMemory(1000));
        $this->assertSame('1 kilobytes', $debug->readableMemory(1025));
        $this->assertSame('1024 kilobytes', $debug->readableMemory(1048575));
        
    }
}
