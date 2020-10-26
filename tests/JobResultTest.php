<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\ParserResult;

class JobResultTest extends CrawlerTestCase
{
    public function testTrim()
    {
        $result = new ParserResult();

        $this->assertSame('foo bar', $result->trim('          foo                 bar        '));
        $this->assertSame('foo bar', $result->trim('          foo        
        
        bar        '));
    }
}
