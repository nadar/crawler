<?php

namespace Nadar\PageCrawler\Formats;

use DOMDocument;
use Nadar\PageCrawler\FormatInterface;
use Nadar\PageCrawler\Job;
use Nadar\PageCrawler\JobResult;
use Nadar\PageCrawler\RequestResponse;
use Nadar\PageCrawler\Result;
use Nadar\PageCrawler\Url;

class Html implements FormatInterface
{
    public function run(Job $job, RequestResponse $requestResponse) : JobResult
    {
        //Create a new DOM document
        $dom = new DOMDocument();

        //Parse the HTML. The @ is used to suppress any parsing errors
        //that will be thrown if the $html string isn't valid XHTML.
        @$dom->loadHTML($requestResponse->getContent());

        //Get all links. You could also use any other tag name here,
        //like 'img' or 'table', to extract other tags.
        $links = $dom->getElementsByTagName('a');

        $refs = [];

        //Iterate over the extracted links and display their URLs
        foreach ($links as $link) {
            //Extract and show the "href" attribute.
            $refs[] = $link->getAttribute('href');
        }

        $title = null;
        $list = $dom->getElementsByTagName("title");
        if ($list->length > 0) {
            $title = $list->item(0)->textContent;
        }
        

        $jobResult = new JobResult();
        $jobResult->content = $requestResponse->getContent();
        $jobResult->title = $title;
        $jobResult->followUrls = $refs;
        
        unset($dom, $links, $refs, $link, $requestResponse);

        return $jobResult;
    }

    public function validateUrl(Url $url) : bool
    {
        return in_array($url->getPathExtension(), ['', 'html', 'php', 'html']);
    }

    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return in_array($requestResponse->getContentType(), ['text/html']);
    }
}