<?php

namespace Nadar\PageCrawler;

interface FormatInterface
{
    public function __construct(Job $job);

    public function supportedContentTypes() : array;

    public function run() : JobResult;
}