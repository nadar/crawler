<?php

namespace Nadar\Crawler\Parsers;

use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Job;
use Nadar\Crawler\JobResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;
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