<?php

namespace Nadar\Crawler\Storage;

use Exception;
use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\StorageInterface;
use Nadar\Crawler\QueueItem;

/**
 * File Storage
 * 
 * Storage the current crawler process queue inside txt files.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class FileStorage implements StorageInterface
{
    protected $folder;
    
    public $doneFileName = 'done.txt';
    public $checksumFileName = 'checksum.txt';
    public $queueFileName = 'queue.txt';

    public function __construct($folder)
    {
        $folder = trim(rtrim($folder, DIRECTORY_SEPARATOR));

        if (!is_writable($folder)) {
            throw new Exception("The folder \"{$folder}\" is not writeable.");
        }

        $this->folder = $folder . DIRECTORY_SEPARATOR;
    }

    public function fileToArray($file)
    {
        $array = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        return $array;
    }

    /**
     * {@inheritDoc}
     */
    public function onSetup(Crawler $crawler)
    {
        file_put_contents($this->folder . $this->doneFileName, '');
        file_put_contents($this->folder . $this->checksumFileName, '');
        file_put_contents($this->folder . $this->queueFileName, '');
    }

    /**
     * {@inheritDoc}
     */
    public function onEnd(Crawler $crawler)
    {
        unlink($this->folder . $this->doneFileName);
        unlink($this->folder . $this->checksumFileName);
        unlink($this->folder . $this->queueFileName);
    }

    /**
     * {@inheritDoc}
     */
    public function isUrlDone($url) : bool
    {
        return in_array($url, $this->fileToArray($this->folder . $this->doneFileName));
    }

    /**
     * {@inheritDoc}
     */
    public function markUrlAsDone($url)
    {
        file_put_contents($this->folder . $this->doneFileName, $url . PHP_EOL, FILE_APPEND);
    }

    /**
     * {@inheritDoc}
     */
    public function isChecksumDone($checksum) : bool
    {
        return in_array($checksum, $this->fileToArray($this->folder . $this->checksumFileName));
    }

    /**
     * {@inheritDoc}
     */
    public function markChecksumAsDone($checksum)
    {
        file_put_contents($this->folder . $this->checksumFileName, $checksum . PHP_EOL, FILE_APPEND);
    }

    /**
     * {@inheritDoc}
     */
    public function pushQueue(QueueItem $queueItem)
    {
        file_put_contents($this->folder . $this->queueFileName, "$queueItem->url;$queueItem->referrerUrl" . PHP_EOL, FILE_APPEND);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieveQueue($amount): array
    {
        $rows = file($this->folder . $this->queueFileName);

        $data = array_splice($rows, 0, $amount);

        file_put_contents($this->folder . $this->queueFileName, $rows);

        $items = [];
        foreach ($data as $row) {
            list($url, $ref) = explode(";", $row);
            $items[] = new QueueItem(trim($url), trim($ref));
        }

        unset($rows, $data);

        return $items;
    }
}
