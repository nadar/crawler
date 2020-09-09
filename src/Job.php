<?php

namespace Nadar\Crawler;

/**
 * URL Job
 * 
 * The job class is the main class which combines handlers and parsers for a given URL.
 */
class Job
{
    public $url;

    public $referrerUrl;

    public function __construct(Url $url, Url $referrerUrl)
    {
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;
    }

    public function validate(Crawler $crawler) : bool
    {
        foreach ($crawler->getParsers() as $handler) {
            if ($handler->validateUrl($this->url)) {
                return true;
            }
        }

        return false;
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

    public function run(RequestResponse $requestResponse, Crawler $crawler)
    {
        foreach ($crawler->getParsers() as $parser) {
            if ($parser->validateRequestResponse($requestResponse)) {
                $jobResult = $parser->run($this, $requestResponse);

                foreach ($jobResult->followUrls as $url) {
                    $url = new Url($url);
                    $url->merge($crawler->baseUrl);

                    if ($url->isValid() && $crawler->baseUrl->sameHost($url)) {
                        $job = new Job($url, $this->url);
                        $crawler->push($job);
                        unset($job);
                    }
                    
                    unset($url);
                }

                if ($jobResult->ignore) {
                    // for whatever reason the parser ignores this url
                    continue;
                }

                $result = new Result();

                $result->refererUrl = $this->referrerUrl;
                $result->contentType = $requestResponse->getContentType();
                $result->parser = get_class($parser);
                $result->checksum = $requestResponse->getChecksum();

                $result->url = $this->url;
                $result->language = $jobResult->language;
                $result->title = $jobResult->title;
                $result->content = $jobResult->content;
                $result->keywords = $jobResult->keywords;
                $result->description = $jobResult->description;
                $result->group = $jobResult->group;

                // post the result to the handlers
                foreach ($crawler->getHandlers() as $handler) {
                    $handler->afterRun($result);
                }

                unset($handler, $result, $jobResult);
            }
        }

        unset($parser, $requestResponse);
    }
}
