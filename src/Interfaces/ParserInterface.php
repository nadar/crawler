<?php

namespace Nadar\PageCrawler\Interfaces;

use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;
use Nadar\PageCrawler\RequestResponse;
use Nadar\PageCrawler\Url;

interface ParserInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult;

    public function validateUrl(Url $url) : bool;

    public function validateRequestResponse(RequestResponse $requestResponse): bool;
}