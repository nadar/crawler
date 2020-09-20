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
                $parserResult = $parser->run($this, $requestResponse);

                foreach ($parserResult->links as $url) {
                    $url = new Url($url);
                    $url->merge($crawler->baseUrl);

                    if ($url->isValid() && $crawler->baseUrl->sameHost($url)) {
                        $job = new Job($url, $this->url);
                        $crawler->push($job);
                        unset($job);
                    }
                    
                    unset($url);
                }

                if ($parserResult->ignore) {
                    // for whatever reason the parser ignores this url
                    continue;
                }

                $result = new Result();

                $result->refererUrl = $this->referrerUrl;
                $result->contentType = $requestResponse->getContentType();
                $result->parser = $parser;
                $result->parserResult = $parserResult;
                $result->checksum = $requestResponse->getChecksum();

                $result->url = $this->url;
                $result->language = $parserResult->language;
                $result->title = $parserResult->title;
                $result->content = $parserResult->content;
                $result->keywords = $parserResult->keywords;
                $result->description = $parserResult->description;
                $result->group = $parserResult->group;

                // post the result to the handlers
                foreach ($crawler->getHandlers() as $handler) {
                    $handler->afterRun($result);
                }

                unset($handler, $result, $parserResult);
            }
        }

        unset($parser, $requestResponse);
    }
}
