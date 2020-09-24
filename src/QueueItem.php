<?php

namespace Nadar\Crawler;

/**
 * Queue Item
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class QueueItem
{
    public $url;

    public $referrerUrl;

    public function __construct($url, $referrerUrl)
    {
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;
    }
}
