<?php

namespace Nadar\Crawler\Storage;

use Exception;
use Nadar\Crawler\Crawler;
use Nadar\Crawler\Interfaces\StorageInterface;
use Nadar\Crawler\QueueItem;

class FileStorage implements StorageInterface
{
    protected $folder;
    
    public $doneFileName = 'done.txt';
    public $checksumFileName = 'checksum.txt';
    public $queueFileName = 'queue.txt';

    public function __construct($folder)
    {
        $this->folder = trim($folder) . DIRECTORY_SEPARATOR;

        if (!is_writable($this->folder)) {
            throw new Exception("The folder {$this->folder} is not writeable.");
        }
    }

    public function fileToArray($file)
    {
        $array = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        return $array;
    }

    public function onSetup(Crawler $crawler)
    {
        file_put_contents($this->folder . $this->doneFileName, '');
        file_put_contents($this->folder . $this->checksumFileName, '');
        file_put_contents($this->folder . $this->queueFileName, '');
    }

    public function onEnd(Crawler $crawler)
    {
        unlink($this->folder . $this->doneFileName);
        unlink($this->folder . $this->checksumFileName);
        unlink($this->folder . $this->queueFileName);
    }

    public function isUrlDone($url) : bool
    {
        return in_array($url, $this->fileToArray($this->folder . $this->doneFileName));
    }

    public function markUrlAsDone($url)
    {
        file_put_contents($this->folder . $this->doneFileName, $url . PHP_EOL, FILE_APPEND);
    }

    public function isChecksumDone($checksum) : bool
    {
        return in_array($checksum, $this->fileToArray($this->folder . $this->checksumFileName));
    }

    public function markChecksumAsDone($checksum)
    {
        file_put_contents($this->folder . $this->checksumFileName, $checksum . PHP_EOL, FILE_APPEND);
    }

    public function pushQueue(QueueItem $queueItem)
    {
        file_put_contents($this->folder . $this->queueFileName, "$queueItem->url;$queueItem->referrerUrl" . PHP_EOL, FILE_APPEND);
    }

    /**
     * Must return an array with QueueItem objects and the retrieved items MUST be deleted from the queue!
     *
     * + Must return an array with QueueItems
     * + The runtime stack integrator retrieveQueue() must take care of empting the queue
     * + empty if the queue is empty, an empty array will be returned. so the crawler knows to finish the crawler process.
     *
     * @param integer $amount
     * @return array
     */
    public function retrieveQueue($amount): array
    {
        $rows = file($this->folder . $this->queueFileName);

        $data = array_splice($rows, 0, $amount);

        file_put_contents($this->folder . $this->queueFileName, $rows);

        $items = [];
        foreach ($data as $row) {
            list($url, $ref) = explode(";", $row);
            $items[] = new QueueItem($url, $ref);
        }

        unset($rows, $data);

        return $items;
    }
}
