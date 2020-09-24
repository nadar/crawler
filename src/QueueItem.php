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
    /**
     * @var string The url which is queueing to be processed. f.e. https://luya.io/go/there
     */
    public $url;

    /**
     * @var string The referrer url which found {{$url}}
     */
    public $referrerUrl;

    /**
     * Constructor
     *
     * @param string $url
     * @param string $referrerUrl
     */
    public function __construct($url, $referrerUrl)
    {
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;
    }
}
