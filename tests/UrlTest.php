<?php

namespace Nadar\Crawler\Tests;

use Nadar\Crawler\Url;

class UrlTest extends CrawlerTestCase
{
    public function testUrlNoramlizer()
    {
        $url = new Url('https://luya.io/foobar?bar=1');
        $this->assertSame('https://luya.io/foobar?bar=1', $url->getNormalized());
    }

    public function testPdfFileName()
    {
        $url = new Url('https://luya.io/files/thisismysuper.pdf');
        $this->assertSame('thisismysuper.pdf', $url->getPathFileName());
        $this->assertSame('pdf', $url->getPathExtension());
        $this->assertSame('https://luya.io/files/thisismysuper.pdf', $url->getNormalized());
        $this->assertSame('luya.iofiles/thisismysuper.pdf', $url->getUniqueKey());
        $this->assertSame('luya.io', $url->getHost());
        $this->assertSame('/files/thisismysuper.pdf', $url->getPath());
        $this->assertSame('thisismysuper.pdf', $url->getPathFileName());
        $this->assertSame(false, $url->getQuery());
        $this->assertSame('https', $url->getScheme());
        $this->assertSame(true, $url->isValid());
        $this->assertTrue($url->sameHost(new Url('https://luya.io')));
        $this->assertFalse($url->sameHost(new Url('https://nadar.io')));
    }

    public function testMerge()
    {
        $a = new Url('/foobar');
        $b = new Url('https://nadar.io/barfoo');
        

        $this->assertSame('nadar.io', $a->merge($b)->getHost());
        $this->assertSame('https', $a->merge($b)->getScheme());

        $this->assertSame('nadar.io', $b->merge($a)->getHost()); // nothing will happen as host exists
        $this->assertSame('https', $b->merge($a)->getScheme()); // nothing will happen as scheme exists
    }

    public function testEncode()
    {
        // https://www.ahv-iv.ch/de/Merkblätter-Formulare/Formulare/Elektronische-Formulare/AHV-Formulare/318260-Anmeldung-für-einen-Versicherungsausweis
        // https://www.ahv-iv.ch/it/Opuscoli-Moduli/Moduli/Prestazioni-dellIPG-servizio-e-maternità

        $u = new Url('https://www.ahv-iv.ch/de/Merkblätter/Versicherungsausweis');
        $u->encode = true;

        $this->assertSame('/de/Merkbl%C3%A4tter/Versicherungsausweis', $u->getPath());

        $u = new Url('https://luya.io/äà');
        $this->assertSame('https://luya.io/äà', $u->getNormalized());

        $u = new Url('https://luya.io/äà');
        $this->assertSame('https://luya.io/äà', $u->getNormalized());
        $u->encode = true;
        $this->assertSame('https://luya.io/%C3%A4%C3%A0', $u->getNormalized());
        $this->assertSame('/%C3%A4%C3%A0', $u->getPath());
        $this->assertSame('https://luya.io/äà', urldecode($u->getNormalized()));

        $u = new Url('https://luya.io/a/a');
        $u->encode = true;
        $this->assertSame('https://luya.io/a/a', $u->getNormalized());
    }

    public function testInvalidUrl()
    {
        $this->assertFalse((new Url('mailto:johndoe@example.com'))->isValid());
        $this->assertFalse((new Url('tel:123123123'))->isValid());
        $this->assertTrue((new Url('https://luya.io'))->isValid());
        $this->assertTrue((new Url('/admin/path'))->isValid());
    }

    public function testIsRelative()
    {
        $this->assertFalse((new Url('https://luya.io'))->isRelative());
        $this->assertFalse((new Url('https://luya.io/path//double'))->isRelative());
        $this->assertFalse((new Url('//path-without-host'))->isRelative());
        $this->assertTrue((new Url('/path-without-host'))->isRelative());
        $this->assertTrue((new Url('path-without-host/base-path-info-required'))->isRelative());
    }

    public function testQueryParamOnly()
    {
        $url = new Url('?foo=bar');
        $this->assertTrue($url->isRelative());

        $url->merge(new Url('https://luya.io/current/path'));
        $this->assertSame('https://luya.io/current/path?foo=bar', $url->getNormalized());
    }
}
