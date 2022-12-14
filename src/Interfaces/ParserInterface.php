<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Job;
use Nadar\Crawler\ParserResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;

/**
 * Parser Interface
 *
 * The parser is the main task which is analysing the response from a given URL and return a result.
 *
 * The parsers is triggered by the Job object and therfore cycles trough 3 steps.
 *
 * 1. The url will be validated with validateUrl(), if validation succeed. A CURL request will be made
 * 2. The CURL Request will be passed to validateRequestResponse() in order to verify mime type / content type values. if validation succeed run will be invoken
 * 3. The run method will be invoken which needs to return a ParserResult (this can be either contain an ignore flag or not).
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
interface ParserInterface
{
    /**
     * Validate the URL to match the Parsers Format.
     *
     * @param Url $url
     * @return boolean Whether the validation is sucessfull or not, if not the parsers will be ignored at this point for the given url.
     */
    public function validateUrl(Url $url): bool;

    /**
     * Validate the URLs request response body
     *
     * @param RequestResponse $requestResponse
     * @return boolean Whether the validation is sucessfull or not, if not the parsers will be ignored at this point for the given url.
     */
    public function validateRequestResponse(RequestResponse $requestResponse): bool;

    /**
     * Run the parser, extract informations and respond with a ParserResult
     *
     * @param Job $job
     * @param RequestResponse $requestResponse
     * @return ParserResult
     */
    public function run(Job $job, RequestResponse $requestResponse): ParserResult;
}
