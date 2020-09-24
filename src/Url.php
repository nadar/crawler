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
        return isset($this->parsed['path']) ? $this->parsed['path'] : false;
    }

    /**
     * Get lower case name of the extension like `png`, `pdf` if any. false otherwise
     *
     * @return string
     */
    public function getPathExtension()
    {
        return $this->getPath() ? strtolower(pathinfo($this->getPath(), PATHINFO_EXTENSION)) : false;
    }

    public function getPathFileName()
    {
        return basename($this->getPath());
    }

    public function getQuery()
    {
        return isset($this->parsed['query']) ? $this->parsed['query'] : false;
    }

    public function getScheme()
    {
        return isset($this->parsed['scheme']) ? $this->parsed['scheme'] : false;
    }

    public function sameHost(Url $url)
    {
        return $this->getHost() == $url->getHost();
    }

    public function isValid()
    {
        // filter out: mailto:, tel:

        return true;
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
}
