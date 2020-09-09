<?php

namespace Nadar\Crawler\Tests\Parsers;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Job;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\ArrayStorage;
use Nadar\Crawler\Tests\CrawlerTestCase;
use Nadar\Crawler\Url;

class HtmlParserTest extends CrawlerTestCase
{
    public function testDomDocuemntReaderInformations()
    {
        $parser = new HtmlParser;

        $dom = $parser->generateDomDocuemnt('<!doctype html><html lang="de">
        <head>
            <meta name="description" content="meta meta">
            <meta name="keywords" content="kws kws">
            <title>title</title>
        </head>
        <body>content</body>
</html>');
        $this->assertSame('de', $parser->getDomLanguage($dom));
        $this->assertSame('title', $parser->getDomTitle($dom));
        $this->assertSame('meta meta', $parser->getDomDescription($dom));
        $this->assertSame('kws kws', $parser->getDomKeywords($dom));

        // test with invalid or none existing html lang attribute

        $dom = $parser->generateDomDocuemnt('<!doctype html><html><head><title>title</title></head><body>content</body></html>');
        $this->assertSame(null, $parser->getDomLanguage($dom));
        
    }

    public function testCrawlerTags()
    {
        $parser = new HtmlParser;
        $this->assertSame('hello  are you?', $parser->stripCrawlIgnore('hello [CRAWL_IGNORE]how[/CRAWL_IGNORE] are you?'));
        $this->assertSame('the', $parser->getCrawlGroup('this is [CRAWL_GROUP]the[/CRAWL_GROUP] group'));
    }

    public function testGetContent()
    {
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));

        $requestResponse = new RequestResponse('
        <!doctype html>
        <html>
        <head>
            <title>Example Domain</title>
        
            <meta charset="utf-8" />
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <style type="text/css">
            body {
                background-color: #f0f0f2;
                margin: 0;
                padding: 0;
                font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
                
            }
            div {
                width: 600px;
                margin: 5em auto;
                padding: 2em;
                background-color: #fdfdff;
                border-radius: 0.5em;
                box-shadow: 2px 3px 7px 2px rgba(0,0,0,0.02);
            }
            a:link, a:visited {
                color: #38488f;
                text-decoration: none;
            }
            @media (max-width: 700px) {
                div {
                    margin: 0 auto;
                    width: auto;
                }
            }
            </style>    
        </head>
        
        <body>
        <div>
            <h1>Example Domain</h1>
            <p>This domain is for use in illustrative examples in documents. You may use this
            domain in literature without prior coordination or asking for permission.</p>
            <p><a href="https://www.iana.org/domains/example">More information...</a></p>
        </div>
        </body>
        </html>
        ', 'text/html');

        $parser = new HtmlParser();
        $parser->stripTags = false;
        $result = $parser->run($job, $requestResponse);

        $this->assertSame('<body> <div> <h1>Example Domain</h1> <p>This domain is for use in illustrative examples in documents. You may use this domain in literature without prior coordination or asking for permission.</p> <p><a href="https://www.iana.org/domains/example">More information...</a></p> </div> </body>', $result->content);

        $this->assertSame('Example Domain', $result->title);

        // test job run

        $crawler = new Crawler('https://example.com', new ArrayStorage, new LoopRunner);
        $run = $job->run($requestResponse, $crawler);

        $this->assertEmpty($run);

        // the domain in the content is another domain and there no further link to process
        $this->assertSame([], $crawler->retrieveQueueJobs());
    }
}