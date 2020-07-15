<?php

namespace Nadar\PageCrawler\Formats;

use Nadar\PageCrawler\FormatInterface;
use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;
use Nadar\PageCrawler\RequestResponse;
use Nadar\PageCrawler\Url;

class Pdf implements FormatInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult
    {
        return new JobResult();
    }

    public function validateUrl(Url $url) : bool
    {
        // if url endung: "pdf"
        return true;
    }

    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return false;
    }
}