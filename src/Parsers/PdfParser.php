<?php

namespace Nadar\PageCrawler\Parsers;

use Nadar\PageCrawler\Interfaces\ParserInterface;
use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;
use Nadar\PageCrawler\RequestResponse;
use Nadar\PageCrawler\Url;
use Smalot\PdfParser\Parser;

class PdfParser implements ParserInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult
    {
        $parser = new Parser();
        $pdf = $parser->parseContent($requestResponse->getContent());
        $content = null;
        foreach ($pdf->getPages() as $page) {
            $content .= $page->getText();
        }
        $result = new JobResult();
        $result->content = $content;
        $result->title = $job->url->getPathFileName();

        unset($parser, $pdf, $content);
        return $result;
    }

    public function validateUrl(Url $url) : bool
    {
        return in_array($url->getPathExtension(), ['pdf']);
    }

    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return in_array($requestResponse->getContentType(), ['application/pdf']);
    }
}