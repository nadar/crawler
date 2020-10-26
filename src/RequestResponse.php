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
    /**
     * @var string Contains the response content.
     */
    protected $content;
    
    /**
     * @var string Contains the response content type
     */
    protected $contentType;

    /**
     * Constructor
     *
     * @param string $content
     * @param string $contentType
     */
    public function __construct($content, $contentType)
    {
        $this->content = $content;
        $this->contentType = trim($contentType);
    }

    /**
     * Getter method fro the content.
     *
     * > This might be a very very large string.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    private $_checksum;

    /**
     * Getter method for the checksum
     *
     * @return string
     */
    public function getChecksum()
    {
        if ($this->_checksum === null) {
            $this->_checksum = md5($this->content);
        }

        return $this->_checksum;
    }

    /**
     * Getter method for content type
     *
     * @return string text/html or application/pdf
     */
    public function getContentType()
    {
        return current(explode(";", $this->contentType));
    }
}
