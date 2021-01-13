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

 * > Attention: Keep in mind that wen you enable the PDF Parser and have multiple concurrent requests this can drastically increases memory
 * > usage (Especially if there are large PDFs)! Therefore it's recommend to lower the concurrent value when enabling PDF Parser!
 *
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class PdfParser implements ParserInterface
{
    /**
     * @var boolean Whether utf8 encoding should be enabled or not.
     */
    public $utf8Encoding = true;

    /**
     * Check whether the Parser class from Smalot exists or not.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (!class_exists(Parser::class)) {
            throw new Exception("In order to use the PDF parsers you have to add `smalot/pdfparser` in your composer.json!");
        }
    }

    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
    public function validateUrl(Url $url) : bool
    {
        return in_array($url->getPathExtension(), ['pdf']);
    }

    /**
     * {@inheritDoc}
     */
    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return $requestResponse->getStatusCode() == 200 && in_array($requestResponse->getContentType(), ['application/pdf']);
    }
}
