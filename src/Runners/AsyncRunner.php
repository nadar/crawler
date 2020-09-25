<?php

namespace Nadar\Crawler\Runners;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\RunnerInterface;

/**
 * Async Runner Example.
 *
 * An example of how to use an Async Runner with Yii Framework Queue.
 *
 * ```php
 * $crawler = new Crawler('https://luya.io', new DatabaseStorage, new AsyncRunner(function($cawler) {
 *      Yii::$app->queue->push(new AsyncQueueJob());
 * }));
 * $crawler->start();
 * $crawler->run();
 * ```
 *
 * Now the process will run the above callable in AsyncRunner after the first iteration, then this queue job starts,
 * here an example of how this queue job could look like. It mainly is the same as the initial run but without start().
 *
 * ```php
 * $crawler = new Crawler('https://luya.io', new DatabaseStorage, new AsyncRunner(function($cawler) {
 *      Yii::$app->queue->push(new AsyncQueueJob());
 * }));
 * $crawler->run();
 * ```
 *
 * This will now run async until all pages are crawled.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class AsyncRunner implements RunnerInterface
{
    public $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * {@inheritDoc}
     */
    public function afterRun(Crawler $crawler)
    {
        call_user_func($this->callable, $crawler);
    }
}
