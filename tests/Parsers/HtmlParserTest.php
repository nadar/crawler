<?php

namespace Nadar\Crawler\Tests\Parsers;

use DOMDocument;
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

        $dom = $parser->generateDomDocument('<!doctype html><html lang="de">
        <head>
            <meta name="description" content="meta meta">
            <meta name="keywords" content="kws kws">
            <title>title</title>
        </head>
        <body><script>alert(1)</script>between<script type="text/javascript">alert(2)</script><p>the lines</p><style>body {background-color: linen;}</style></body>
</html>');

        $this->assertSame('<body>between<p>the lines</p></body>', str_replace(['\n', '\r', PHP_EOL], '', $parser->getDomBodyContent($dom)));

        $this->assertNull(
            $parser->getDomBodyContent(new DOMDocument())
        );
    }

    public function testFullIgnoreTag()
    {
        $parser = new HtmlParser;
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));
        $requestResponse = new RequestResponse('<!doctype html><html lang="de">
        <head>
        </head>
        <body>test [CRAWL_FULL_IGNORE]</body>
</html>', 'text/html', 200);

        $crawler = new Crawler('https://example.com/', new ArrayStorage, new LoopRunner);
        $debug = new DebugHandler;

        $crawler->addHandler($debug);
        $job->run($requestResponse, $crawler);

        $this->assertSame(0, $debug->counter);
    }

    public function testDomDocuemntReaderInformations()
    {
        $parser = new HtmlParser;

        $dom = $parser->generateDomDocument('<!doctype html><html lang="de">
        <head>
            <meta name="description" content="meta meta">
            <meta name="keywords" content="kws kws">
            <title>title</title>
        </head>
        <body>content</body>
</html>');
        $this->assertSame('de', $parser->getDomLanguage($dom));
        $this->assertSame('title', $parser->getDomTitle($dom));
        $this->assertNull($parser->getDomTitle(new DOMDocument()));
        $this->assertNull($parser->getDomLanguage(new DOMDocument()));
        $this->assertSame('meta meta', $parser->getDomDescription($dom));
        $this->assertSame('kws kws', $parser->getDomKeywords($dom));

        // test with invalid or none existing html lang attribute

        $dom = $parser->generateDomDocument('<!doctype html><html><head><title>title</title></head><body>content</body></html>');
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
        ', 'text/html', 200);

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
        $this->assertSame([], $this->invokeMethod($crawler, 'retrieveQueueJobs'));
    }

    public function testCrawlTitle()
    {
        $parser = new HtmlParser;

        $this->assertSame('title', $parser->getCrawlTitle('Foo[CRAWL_TITLE]title[/CRAWL_TITLE]Bar'));

        $this->assertNull($parser->getCrawlTitle('foobar'));
    }

    public function testCrawlFullIgnore()
    {
        $parser = new HtmlParser;

        $this->assertTrue($parser->isCrawlFullIgnore('Foo[CRAWL_FULL_IGNORE]title[/CRAWL_TITLE]Bar'));
    }

    public function testIgnoreContent()
    {
        $html = '<div><p>hallo</p><!-- [CRAWL_IGNORE] --></div><div class="page__content page__content--footer"><div class="wrapper"><div><br /> text</div></div><footer class="footer"><div class="footer__inner"><div class="wrapper"><div class="footer__row"><div class="footer__column footer__column--main"><div class="footer__column footer__column--left"><div class="footer__column footer__column--footernav"><ul class="footernav"><li class="footernav__item"><a class="footernav__link" href="/de/sites">Sitemap</a></li><li class="footernav__item"><a class="footernav__link" href="/de/impressum">Impressum</a></li><li class="footernav__item"><a class="footernav__link" href="/de/agb">AGB</a></li><li class="footernav__item"><a class="footernav__link" href="/de/datenschutzerklaerung">Datenschutzerklärung</a></li></ul></div></div><div class="footer__column footer__column--right"><div class="footer__column footer__column--copyright"> company </div></div></div><div class="footer__column footer__column--social"><ul class="footernav footernav--socials"><li class="footernav__item"><a class="footernav__link" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li><li class="footernav__item"><a class="footernav__link" href="https://www.linkedin.com/company/" target="_blank"><i class="fab fa-linkedin"></i></a></li></ul></div></div></div></div></footer></div></div><!-- Root element of PhotoSwipe. Must have class pswp. --><div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><!-- Background of PhotoSwipe. It\'s a separate element as animating opacity is faster than rgba(). --><div class="pswp__bg"></div><!-- Slides wrapper with overflow:hidden. --><div class="pswp__scroll-wrap"><!-- Container that holds slides. PhotoSwipe keeps only 3 of them in the DOM to save memory. Don\'t modify these 3 pswp__item elements, data is added later on. --><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. --><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><!-- Controls are self-explanatory. Order can be changed. --><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR --><!-- element will get class pswp__preloader--active when preloader is running --><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div><!-- [/CRAWL_IGNORE] --></div>';
        $parser = new HtmlParser;
    
        $this->assertSame('<div><p>hallo</p><!--  --></div>', $parser->stripCrawlIgnore($html));
    }
}
