<?php

namespace Nadar\Crawler\Tests\Parsers;

use Nadar\Crawler\Crawler;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Job;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Runners\LoopRunner;
use Nadar\Crawler\Storage\ArrayStorage;
use Nadar\Crawler\Tests\CrawlerTestCase;
use Nadar\Crawler\Url;

class HtmlParserTest extends CrawlerTestCase
{
    public function testDomDocumentRemoveScriptInformations()
    {
        $parser = new HtmlParser;

        $dom = $parser->generateDomDocuemnt('<!doctype html><html lang="de">
        <head>
            <meta name="description" content="meta meta">
            <meta name="keywords" content="kws kws">
            <title>title</title>
        </head>
        <body><script>alert(1)</script>between<script type="text/javascript">alert(2)</script><p>the lines</p><style>body {background-color: linen;}</style></body>
</html>');

        $this->assertSame('<body>between<p>the lines</p></body>', str_replace(['\n', '\r', PHP_EOL], '', $parser->getDomBodyContent($dom)));
    }

    public function testFullIgnoreTag()
    {
        $parser = new HtmlParser;
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));
        $requestResponse = new RequestResponse('<!doctype html><html lang="de">
        <head>
        </head>
        <body>test [CRAWL_FULL_IGNORE]</body>
</html>', 'text/html');

        $crawler = new Crawler('https://example.com/', new ArrayStorage, new LoopRunner);
        $debug = new DebugHandler;

        $crawler->addHandler($debug);
        $job->run($requestResponse, $crawler);

        $this->assertSame(0, $debug->counter);
    }

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
            <p>This domain is for use in [CRAWL_IGNORE]illustrative[/CRAWL_IGNORE] examples in documents. You may use this
            domain in literature without prior coordination or asking for permission.</p>
            <p><a href="https://www.iana.org/domains/example">More information...</a></p>
        </div>
        </body>
        </html>
        ', 'text/html');

        $parser = new HtmlParser();
        $parser->stripTags = false;
        $result = $parser->run($job, $requestResponse);

        $this->assertSame('<body> <div> <h1>Example Domain</h1> <p>This domain is for use in examples in documents. You may use this domain in literature without prior coordination or asking for permission.</p> <p><a href="https://www.iana.org/domains/example">More information...</a></p> </div> </body>', $result->content);

        $this->assertSame('Example Domain', $result->title);

        // test job run

        $crawler = new Crawler('https://example.com', new ArrayStorage, new LoopRunner);
        $run = $job->run($requestResponse, $crawler);

        $this->assertEmpty($run);

        // the domain in the content is another domain and there no further link to process
        $this->assertSame([], $crawler->retrieveQueueJobs());
    }

    public function testCrawlTitle()
    {
        $parser = new HtmlParser;

        $this->assertSame('title', $parser->getCrawlTitle('Foo[CRAWL_TITLE]title[/CRAWL_TITLE]Bar'));
    }

    public function testCrawlFullIgnore()
    {
        

        $parser = new HtmlParser;

        $this->assertTrue($parser->isCrawlFullIgnore('Foo[CRAWL_FULL_IGNORE]title[/CRAWL_TITLE]Bar'));
    }
}