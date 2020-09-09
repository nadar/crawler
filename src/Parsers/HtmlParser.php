<?php

namespace Nadar\Crawler\Parsers;

use DOMDocument;
use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Job;
use Nadar\Crawler\JobIgnoreResult;
use Nadar\Crawler\JobResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;

class HtmlParser implements ParserInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult
    {
        if ($this->isCrawlFullIgnore($requestResponse->getContent())) {
            return new JobIgnoreResult();
        }
        
        $dom = new DOMDocument();

        // Parse the HTML. The @ is used to suppress any parsing errors
        // that will be thrown if the $html string isn't valid XHTML.
        @$dom->loadHTML($requestResponse->getContent());

        // follow links
        $links = $dom->getElementsByTagName('a');
        $refs = [];
        foreach ($links as $link) {
            $refs[] = $link->getAttribute('href');
        }

        // title
        $title = null;
        $list = $dom->getElementsByTagName("title");
        if ($list->length > 0) {
            $title = $list->item(0)->textContent;
        }

        // body content
        $content = $requestResponse->getContent();
        $body = $dom->getElementsByTagName('body');
        if ($body && $body->length > 0) {
            $node = $body->item(0);
            $content = $dom->saveHTML($node);

            unset($node);
        }

        $jobResult = new JobResult();
        $jobResult->content = $content; // get only the content between "body" tags
        $jobResult->title = $title;
        $jobResult->followUrls = $refs;
        
        unset($dom, $links, $refs, $link, $requestResponse, $content, $body);

        return $jobResult;
    }

    public function validateUrl(Url $url) : bool
    {
        return in_array($url->getPathExtension(), ['', 'html', 'php', 'htm']);
    }

    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return in_array($requestResponse->getContentType(), ['text/html']);
    }

    public function isCrawlFullIgnore($content)
    {
        preg_match("/\[CRAWL_FULL_IGNORE\]/s", $content, $output);

        if (isset($output[0]) && $output[0] == '[CRAWL_FULL_IGNORE]') {
            return true;
        }

        return false;
    }
}
