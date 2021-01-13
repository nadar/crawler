<?php

namespace Nadar\Crawler\Handlers;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\HandlerInterface;
use Nadar\Crawler\Result;

/**
 * Debug Handler
 *
 * Prints information to the output.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class DebugHandler implements HandlerInterface
{
    /**
     * @var integer Contains the index size which will be increased
     */
    public $counter = 0;

    /**
     * @var integer Starttime
     */
    public $start;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->start = microtime(true);
    }

    /**
     * Returns the current elapsed time from start
     *
     * @return integer
     */
    public function elapsedTime()
    {
        return microtime(true) - $this->start;
    }

    /**
     * Generate memory peak usage
     *
     * @return string
     */
    public function memoryPeak()
    {
        return $this->readableMemory(memory_get_peak_usage(true));
    }

    /**
     * Generate current mmemory usage
     *
     * @return string
     */
    public function memory()
    {
        return $this->readableMemory(memory_get_usage(true));
    }

    /**
     * Returns the readable value of a memory
     *
     * @param integer $memory
     * @return string
     */
    public function readableMemory($memory)
    {
        if ($memory < 1024) {
            return $memory." bytes";
        } elseif ($memory < 1048576) {
            return round($memory/1024, 2)." kilobytes";
        }
        
        return round($memory/1048576, 2)." megabytes";
    }

    /**
     * {@inheritDoc}
     */
    public function onSetup(Crawler $crawler)
    {
        gc_collect_cycles();
    }

    /**
     * {@inheritDoc}
     */
    public function onEnd(Crawler $crawler)
    {
        $this->summary($crawler->getCycles());
    }

    /**
     * {@inheritDoc}
     */
    public function afterRun(Result $result)
    {
        $this->counter++;
        echo $result->url->getNormalized() . " | " . $result->title . " |  " . $this->memory() . PHP_EOL;
    }

    /**
     * Generates and prints a summary
     */
    public function summary($cycles)
    {
        echo "==================" . PHP_EOL;
        echo "run cycles: " . $cycles . PHP_EOL;
        echo "index size: " . ($this->counter) . PHP_EOL;
        echo "time: " . ($this->elapsedTime()) . PHP_EOL;
        echo "memory peak: " . $this->memoryPeak() . PHP_EOL;
        echo "memory: " . $this->memory() . PHP_EOL;
    }
}
