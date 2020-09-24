<?php

namespace Nadar\Crawler\Parsers;

use DOMDocument;
use Nadar\Crawler\Interfaces\ParserInterface;
use Nadar\Crawler\Job;
use Nadar\Crawler\ParserIgnoreResult;
use Nadar\Crawler\ParserResult;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Url;

/**
 * Html Parser
 * 
 * @author Basil Suter <git@nadar.io>
 * @since 1.0.0
 */
class HtmlParser implements ParserInterface
{
    public $stripTags = true;

    /**
     * {@inheritDoc}
     */
    public function run(Job $job, RequestResponse $requestResponse) : ParserResult
    {
        if ($this->isCrawlFullIgnore($requestResponse->getContent())) {
            return new ParserIgnoreResult();
        }
        
        $content = $requestResponse->getContent();
        $dom = $this->generateDomDocuemnt($content);

        // follow links
        $links = $dom->getElementsByTagName('a');
        $refs = [];
        foreach ($links as $link) {
            $refs[$link->getAttribute('href')] = $link->nodeValue;
        }

        // body content
        $body = $this->getDomBodyContent($dom);
        if (!empty($body)) {
            $content = $body;
        }

        $content = $this->stripTags ? strip_tags($content) : $content;
        $content = $this->stripCrawlIgnore($content);

        $jobResult = new ParserResult();
        $jobResult->content = $jobResult->trim($content); // get only the content between "body" tags
        $jobResult->title = $jobResult->trim($this->getDomTitle($dom));
        $jobResult->links = $refs;
        $jobResult->language = $this->getDomLanguage($dom);
        $jobResult->keywords = $this->getDomKeywords($dom);
        $jobResult->description = $this->getDomDescription($dom);
        $jobResult->group = $this->getCrawlGroup($content);
        
        unset($dom, $links, $refs, $link, $requestResponse, $content, $body);

        return $jobResult;
    }

    /**
     * {@inheritDoc}
     */
    public function validateUrl(Url $url) : bool
    {
        return in_array($url->getPathExtension(), ['', 'html', 'php', 'htm']);
    }

    /**
     * {@inheritDoc}
     */
    public function validateRequestResponse(RequestResponse $requestResponse): bool
    {
        return in_array($requestResponse->getContentType(), ['text/html']);
    }

    /**
     * Undocumented function
     *
     * @param [type] $content
     * @return DOMDocument
     */
    public function generateDomDocuemnt($content)
    {
        $dom = new DOMDocument();

        // Parse the HTML. The @ is used to suppress any parsing errors
        // that will be thrown if the $html string isn't valid XHTML.
        @$dom->loadHTML($content);

        return $dom;
    }

    public function isCrawlFullIgnore($content)
    {
        preg_match("/\[CRAWL_FULL_IGNORE\]/s", $content, $output);

        if (isset($output[0]) && $output[0] == '[CRAWL_FULL_IGNORE]') {
            return true;
        }

        return false;
    }

    public function getCrawlTitle($content)
    {
        preg_match_all("/\[CRAWL_TITLE\](.*?)\[\/CRAWL_TITLE\]/", $content, $results);	

        if (!empty($results) && isset($results[1]) && isset($results[1][0])) {
            return $results[1][0];	
        }	

        return null;
    }

    public function getCrawlGroup($content)
    {
        preg_match_all("/\[CRAWL_GROUP\](.*?)\[\/CRAWL_GROUP\]/", $content, $results);	

        if (!empty($results) && isset($results[1]) && isset($results[1][0])) {	
            return $results[1][0];	
        }

        return null;
    }

    public function stripCrawlIgnore($content)
    {
        preg_match_all("/\[CRAWL_IGNORE\](.*?)\[\/CRAWL_IGNORE\]/s", $content, $output);	
        if (isset($output[0]) && count($output[0]) > 0) {	
            foreach ($output[0] as $ignorPartial) {	
                $content = str_replace($ignorPartial, '', $content);	
            }
        }

        return $content;
    }

    public function getDomBodyContent(DOMDocument $dom)
    {
        foreach (iterator_to_array($dom->getElementsByTagName("script")) as $node) {
            $node->parentNode->removeChild($node);
        }

        foreach (iterator_to_array($dom->getElementsByTagName("style")) as $node) {
            $node->parentNode->removeChild($node);
        }

        // body content
        $body = $dom->getElementsByTagName('body');
        if ($body && $body->length > 0) {
            $node = $body->item(0);
            return $dom->saveHTML($node);
        }
        
        return null;
    }

    public function getDomTitle(DomDocument $dom)
    {
        $list = $dom->getElementsByTagName("title");
        if ($list->length > 0) {
            return $list->item(0)->textContent;
        }

        return null;
    }

    public function getDomLanguage(DOMDocument $dom)
    {
        $html = $dom->getElementsByTagName('html');

        if ($html->length > 0) {
            $tag = $html->item(0);
            return $tag->hasAttribute('lang') ? $tag->getAttribute('lang') : null;
        }

        return null;	
    }

    public function getDomDescription(DOMDocument $dom)
    {
        $metas = $dom->getElementsByTagName('meta');

        foreach ($metas as $meta) {
            if (strtolower($meta->getAttribute('name')) == 'description') {
                return $meta->getAttribute('content');
            }
        }

        return null;
    }

    public function getDomKeywords(DOMDocument $dom)
    {
        $metas = $dom->getElementsByTagName('meta');

        foreach ($metas as $meta) {
            if (strtolower($meta->getAttribute('name')) == 'keywords') {
                return $meta->getAttribute('content');
            }
        }

        return null;
    }
}
