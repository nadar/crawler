<?php

namespace Nadar\PageCrawler\Formats;

use Nadar\PageCrawler\FormatInterface;
use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;

class Html implements FormatInterface
{
    public function __construct(Job $job)
    {

    }

    public function supportedContentTypes(): array
    {
        return ['text/html'];
    }

    public function run(): JobResult
    {
        return new JobResult();
    }
}