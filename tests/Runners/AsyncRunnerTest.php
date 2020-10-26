<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Runners\AsyncRunner;
use Nadar\Crawler\Storage\ArrayStorage;

class AsyncRunnerTest extends CrawlerTestCase
{
    public function testAsyncRunnerCallable()
    {
        $runner = new AsyncRunner(function () {
            // run callable
        });

        $crawler = new Crawler('localhost', new ArrayStorage, $runner);
        $this->assertEmpty($runner->afterRun($crawler));
    }
}
