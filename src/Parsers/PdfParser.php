<?php

namespace Nadar\Crawler\Parsers;

use Exception;
use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Job;
use Nadar\Crawler\ParserIgnoreResult;
use Nadar\Crawler\ParserResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;
use Smalot\PdfParser\Parser;

/**
 * PDF Parser
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class PdfParser implements ParserInterface
{
    public $utf8Encoding = true;

    public function __construct()
    {
        if (!class_exists(Parser::class)) {
            throw new Exception("In order to use the PDF parsers you have to add `smalot/pdfparser` in your composer.json!");
        }
    }

    public function run(Job $job, RequestResponse $requestResponse) : ParserResult
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseContent($requestResponse->getContent());
            $content = null;
            foreach ($pdf->getPages() as $page) {
                $content .= $page->getText();
            }
        } catch (Exception $exception) {
            return new ParserIgnoreResult();
        }

        $result = new ParserResult();
        $result->content = $result->trim($this->utf8Encoding ? mb_convert_encoding($content, 'UTF-8', 'UTF-8') : $content);
        $result->title = $result->trim($job->url->getPathFileName());

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
