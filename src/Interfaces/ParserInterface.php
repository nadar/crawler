<?php

namespace Nadar\Crawler\Interfaces;

use Nadar\Crawler\Job;
use Nadar\Crawler\ParserResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;

interface ParserInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : ParserResult;

    public function validateUrl(Url $url) : bool;

    public function validateRequestResponse(RequestResponse $requestResponse): bool;
}
