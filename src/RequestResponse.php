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
     * @var integer Contains the status code of the current request response.
     * @since 1.5.0
     */
    protected $statusCode;

    /**
     * Constructor
     *
     * @param string $content
     * @param string $contentType
     * @param integer $statusCode {@since 1.5.0}
     */
    public function __construct($content, $contentType, $statusCode)
    {
        $this->content = $content;
        $this->contentType = trim($contentType);
        $this->statusCode = (int) $statusCode;
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

    /**
     * Returns the request response status code.
     *
     * @return integer Example status code would be 200
     * @since 1.5.0
     */
    public function getStatusCode()
    {
        return $this->statusCode;
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
