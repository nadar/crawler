<?php

namespace Nadar\Crawler\Tests\Storage;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\QueueItem;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\FileStorage;
use Nadar\Crawler\Tests\CrawlerTestCase;

class FileStorrageTest extends CrawlerTestCase
{
    public function testFileStorage()
    {
        $folder = dirname(__FILE__) . '/runtime';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $storage = new FileStorage($folder);

        $crawler = new Crawler('localhost', $storage, new LoopRunner);

        
        $storage->onSetup($crawler);
        $this->assertFalse($storage->isUrlDone('test'));
        $this->assertEmpty($storage->markUrlAsDone('test'));
        $this->assertTrue($storage->isUrlDone('test'));

        $this->assertFalse($storage->isChecksumDone('test'));
        $this->assertEmpty($storage->markChecksumAsDone('test'));
        $this->assertTrue($storage->isChecksumDone('test'));

        $item = new QueueItem('localhost', 'localhost');
        $storage->pushQueue($item);

        $array = $storage->retrieveQueue(1);

        $this->assertSame('localhost', $array[0]->url);
        $this->assertSame('localhost', $array[0]->referrerUrl);

        $storage->onEnd($crawler);
    }
}
