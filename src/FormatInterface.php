<?php

namespace Nadar\PageCrawler;

interface FormatInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult;

    public function validateUrl(Url $url) : bool;

    public function validateRequestResponse(RequestResponse $requestResponse): bool;
}