<?php

namespace Nadar\PageCrawler\Formats;

use Nadar\PageCrawler\FormatInterface;
use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;

class Pdf implements FormatInterface
{
    public function __construct(Job $job)
    {

    }

    public function supportedContentTypes(): array
    {
        return ['application/pdf'];
    }

    public function run(): JobResult
    {
        return new JobResult();
    }
}