<?php

namespace Nadar\PageCrawler;

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
        $url = $this->getScheme() . '://' . ltrim($this->getHost(), '/') . '/' . ltrim($this->getPath(), '/');

        if (!empty($this->getQuery())) {
            $url .= '?' . $this->getQuery();
        }

        return $url;
    }

    public function getHost()
    {
        return isset($this->parsed['host']) ? $this->parsed['host'] : false;
    }

    public function getPath()
    {
        return isset($this->parsed['path']) ? $this->parsed['path'] : false;
    }

    public function getPathExtension()
    {
        return $this->getPath() ? pathinfo($this->getPath(), PATHINFO_EXTENSION) : false;
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