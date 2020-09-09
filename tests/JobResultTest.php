<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\JobResult;

class JobResultTest extends CrawlerTestCase
{
    public function testTrim()
    {
        $result = new JobResult();

        $this->assertSame('foo bar', $result->trim('          foo                 bar        '));
        $this->assertSame('foo bar', $result->trim('          foo        
        
        bar        '));
    }
}