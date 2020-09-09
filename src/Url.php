<?php

namespace Nadar\Crawler;

class Url
{
    protected $url;

    protected $parsed;

    public function __construct($url)
    {
        $this->url = trim($url);
        $this->parsed = parse_url($this->url);    
    }

    public function getNormalized()
    {
        $url = $this->getScheme() . '://' . trim($this->getHost(), '/') . '/' . ltrim($this->getPath(), '/');

        if (!empty($this->getQuery())) {
            $url .= '?' . $this->getQuery();
        }

        return $url;
    }

    /**
     * Generate an "unique" key
     *
     * @return void
     */
    public function getUniqueKey()
    {
        return $this->getHost().trim($this->getPath(), '/').$this->getQuery();
    }

    public function getHost()
    {
        return isset($this->parsed['host']) ? $this->parsed['host'] : false;
    }

    public function getPath()
    {
        return isset($this->parsed['path']) ? $this->parsed['path'] : false;
    }

    /**
     * Get lower case name of the extension like `png`, `pdf`
     *
     * @return void
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
     * @param Url $url
     * @return void
     */
    public function merge(Url $url)
    {
        if (empty($this->getHost())) {
            $this->parsed['host'] = $url->getHost();
        }

        if (empty($this->getScheme())) {
            $this->parsed['scheme'] = $url->getScheme();
        }
    }
}