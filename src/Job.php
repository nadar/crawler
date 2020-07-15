<?php

namespace Nadar\PageCrawler;

class Job
{
    protected $crawler;

    public $url;

    protected $referrerUrl;

    public function __construct(Crawler $crawler, Url $url, Url $referrerUrl)
    {
        $this->crawler = $crawler;
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;
    }

    public function validate() : bool {

        foreach ($this->crawler->getFormats() as $handler) {
            if (!$handler->validateUrl($this->url)) {
                return false;
            }
        }

        return true;
    }

    public function generateCurl()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $this->url->getNormalized());
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        return $curl;
    }

    public function run(RequestResponse $requestResponse)
    {
        foreach ($this->crawler->getFormats() as $formatter) {
            if ($formatter->validateRequestResponse($requestResponse)) {
                $jobResult = $formatter->run($this, $requestResponse);

                foreach ($jobResult->followUrls as $url) {
                    $url = new Url($url);
                    $url->merge($this->crawler->baseUrl);

                    if ($this->crawler->baseUrl->sameHost($url)) {
                        $job = new Job($this->crawler, $url, $this->url);
                        $this->crawler->push($job);
                        unset ($job);
                    }
                    
                    unset ($url);
                }

                $result = new Result();
                $result->url = $this->url;
                $result->refererUrl = $this->referrerUrl;
                $result->contentType = $requestResponse->getContentType();
                $result->language = $jobResult->language;
                $result->format = get_class($formatter);
                $result->title = $jobResult->title;

                // post the result to the handlers
                foreach ($this->crawler->getHandlers() as $handler) {
                    $handler->afterRun($result);
                }

                unset($handler, $result, $jobResult);
            }

            unset($formatter);
        }

        unset($requestResponse);
    }
}