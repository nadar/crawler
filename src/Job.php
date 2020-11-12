<?php

namespace Nadar\Crawler;

/**
 * Job for an URL.
 *
 * The job class is the main class which combines handlers and parsers for a given URL.
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class Job
{
    /**
     * @var Url contains the url which should be crawled.
     */
    public $url;

    /**
     * @var Url contains the refferer url which triggered the crawl job (or which found the given page)
     */
    public $referrerUrl;

    /**
     * Construtor
     *
     * @param Url $url
     * @param Url $referrerUrl
     */
    public function __construct(Url $url, Url $referrerUrl)
    {
        $this->url = $url;
        $this->referrerUrl = $referrerUrl;
    }

    /**
     * Whether the job is valid for further processing or not.
     *
     * @param Crawler $crawler
     * @return boolean
     */
    public function validate(Crawler $crawler) : bool
    {
        foreach ($crawler->getParsers() as $handler) {
            if ($handler->validateUrl($this->url)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate curl resource
     *
     * @return resource
     */
    public function generateCurl()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $this->url->getNormalized());
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0); 
        curl_setopt($curl, CURLOPT_TIMEOUT, 5); // timeout after 5 seconds
        return $curl;
    }

    /**
     * Run the crawl job
     *
     * @param RequestResponse $requestResponse
     * @param Crawler $crawler
     */
    public function run(RequestResponse $requestResponse, Crawler $crawler)
    {
        foreach ($crawler->getParsers() as $parser) {
            if ($parser->validateRequestResponse($requestResponse)) {
                $parserResult = $parser->run($this, $requestResponse);

                foreach ($parserResult->links as $url => $linkTitle) {
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
