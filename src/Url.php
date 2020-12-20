<?php

namespace Nadar\Crawler;

/**
 * Represents an URL.
 *
 * In order to retrieve the url from an object use `getNormalized()`. This value is mainly used to identife and store.
 *
 * An example where the url is checked for relative path, merge otherwise and validate:
 * 
 * ```php
 * $url = new Url('/about/me');
 * if ($url->isRelative()) {
 *     $url->merge(new Url('https://luya.io'));
 * }
 * 
 * if ($url->isValid()) {
 *     echo $url->getNormalized(); // outputs https://luya.io/about/me
 * }
 * ```
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
     * Whether the original url is a relative url or not
     *
     * @return boolean
     * @since 1.3.0
     */
    public function isRelative()
    {
        return strncmp($this->url, '//', 2) && strpos($this->url, '://') === false;
    }

    /**
     * If the current URL is missing informations, it cain obtain informations from the merge url.
     * 
     * > By `current URL` it means the value from $this->url.
     * 
     * The following parts will be merged:
     * 
     * + host: If missing in current URL
     * + scheme: If missing in current URL
     * + path: If the current URL is a query parameter only, the path can be merged
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

        // if the url is relative and contains only a query param, the path should be mmerged
        // from the url as well. This ensures urls like `?foo=bar` will be converted to the
        // full path including its path, which is in most cases also the relativ url.
        // @see https://github.com/nadar/crawler/issues/8
        if (empty($this->getPath()) && $this->isRelative() && !empty($this->getQuery())) {
            $this->parsed['path'] = $url->getPath();
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
        return $this->encode ? implode("/", array_map("urlencode", explode("/", $value))) : $value;
    }
}
