<?php

namespace Nadar\Crawler\Tests\Parsers;

use Nadar\Crawler\Job;
use Nadar\Crawler\Parsers\PdfParser;
use Nadar\Crawler\RequestResponse;
use Nadar\Crawler\Tests\CrawlerTestCase;
use Nadar\Crawler\Url;

class PdfParserTest extends CrawlerTestCase
{
    //

    public function testPdfUtf8Issue()
    {
        $job = new Job(new Url('https://example.com/'), new Url('https://example.com/'));

        $pdf = 'https://www.rehab.ch/files/7_Das_REHAB_im_Dialog/Anreisekarte_DE_190923.pdf';

        $requestResponse = new RequestResponse(file_get_contents($pdf), 'application/pdf', 200);

        $parser = new PdfParser();
        $result = $parser->run($job, $requestResponse);
        
        $this->assertTrue($parser->validateRequestResponse($requestResponse));
        $this->assertNotEmpty($result->content);
    }

    public function testValidators()
    {
        $parser = new PdfParser();
        $this->assertTrue($parser->validateUrl(new Url('https://luya.io/test.pdf')));
    }
}
