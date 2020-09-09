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

        $requestResponse = new RequestResponse(file_get_contents($pdf), 'application/pdf');

        $parser = new PdfParser();
        $result = $parser->run($job, $requestResponse);
        
        $this->assertNotEmpty($result->content);
    }
}