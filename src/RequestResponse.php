<?php

namespace Nadar\Crawler;

/**
 * Response from a Request
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class RequestResponse
{
    protected $content;
    
    protected $contentType;

    public function __construct($content, $contentType)
    {
        $this->content = $content;
        $this->contentType = trim($contentType);
    }

    public function getContent()
    {
        return $this->content;
    }

    private $_checksum;

    public function getChecksum()
    {
        if ($this->_checksum === null) {
            $this->_checksum = md5($this->content);
        }

        return $this->_checksum;
    }

    public function getContentType()
    {
        return current(explode(";", $this->contentType));
    }
}
