<?php

namespace Nadar\Crawler;

/**
 * Represents an URL.
 * 
 * In order to retrieve the url from an object use `getNormalized()`. This value is mainly used to identife and store.
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class Url
{
    /**
     * @var string Contains the original provided url.
     */
    protected $url;

    /**
     * @var array Contains the array informations from parse_url() method.
     */
    protected $parsed;

    /**
     * @var boolean Whether values should be encoded when retrieving values or not. By default this is disabled.
     * @since 1.1.0
     */
    public $encode = false;

    /**
     * Constructor
     *
     * @param string $url The url which should be objectified
     */
    public function __construct($url)
    {
        $this->url = trim($url);
        $this->parsed = parse_url($this->url);
    }

    /**
     * Get the normalized url.
     *
     * A normalized urls means that unnecessary url parts are removed but keep the
     * main informations in order to have a valid url.
     * 
     * @return string https://luya.io/admin
     */
    public function getNormalized()
    {
        $url = $this->getScheme() . '://' . trim($this->getHost(), '/') . '/' . ltrim($this->getPath(), '/');

        if (!empty($this->getQuery())) {
            $url .= '?' . $this->getQuery();
        }

        return $url;
    }

    /**
     * Generate an unique url with host, path and query params.
     * 
     * @return string
     */
    public function getUniqueKey()
    {
        return $this->getHost().trim($this->getPath(), '/').$this->getQuery();
    }

    /**
     * Hostname
     *
     * @return string example.com if the url is https://example.com
     */
    public function getHost()
    {
        return isset($this->parsed['host']) ? $this->parsed['host'] : false;
    }

    /**
     * Path
     *
     * @return string admin if the url is https://luya.io/admin
     */
    public function getPath()
    {
        return isset($this->parsed['path']) ? $this->processEncoding($this->parsed['path']) : false;
    }

    /**
     * Get lower case name of the extension like `png`, `pdf` if any. false otherwise
     *
     * @return string Returns the extenion if any, otherwise false
     */
    public function getPathExtension()
    {
        return $this->getPath() ? strtolower(pathinfo($this->getPath(), PATHINFO_EXTENSION)) : false;
    }

    /**
     * Return the filename (or last path entry) from a given url.
     *
     * @return string Returns the filename, for example https://luya.io/storage/example.pdf would return `example.pdf`.
     */
    public function getPathFileName()
    {
        return $this->processEncoding(basename($this->getPath()));
    }

    /**
     * Returns the query params a string without question mark start
     *
     * @return string The query param, f.e. `argument=wert` or false if no query param
     */
    public function getQuery()
    {
        return isset($this->parsed['query']) ? $this->parsed['query'] : false;
    }

    /**
     * Returns the schema from the url
     *
     * @return string The schema f.e. `http` or false if no scheme detected
     */
    public function getScheme()
    {
        return isset($this->parsed['scheme']) ? $this->parsed['scheme'] : false;
    }

    /**
     * Whether the given host is equal to the host of the object
     *
     * @param Url $url
     * @return boolean
     */
    public function sameHost(Url $url)
    {
        return $this->getHost() == $url->getHost();
    }

    /**
     * Whether the current url is a valid url.
     * 
     * A valid url must be have a valid host to connect. Check if scheme contains mailto or tel
     *
     * @return boolean
     */
    public function isValid()
    {
        return !in_array($this->getScheme(), ['mailto', 'tel', 'ftp']);
    }

    /**
     * If the current URL is missing informations, it cain obtain informations from the to merge url
     *
     * Will only merge the host and scheme of the current object with the provided url. Only if those informations are missing.
     *
     * @param Url $url
     * @return static
     */
    public function merge(Url $url)
    {
        if (empty($this->getHost())) {
            $this->parsed['host'] = $url->getHost();
        }

        if (empty($this->getScheme())) {
            $this->parsed['scheme'] = $url->getScheme();
        }

        return $this;
    }

    /**
     * Process a value which will be encoded when enabled. If not the value will be the same from input.
     *
     * @param string $value
     * @return string If encoding is enabled the value will be encoded otherwise return original.
     * @since 1.1
     */
    private function processEncoding($value)
    {
        return $this->encode ? urlencode($value) : $value;
    }
}
