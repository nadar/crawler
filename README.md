# Website Crawler for PHP

![Tests](https://github.com/nadar/php-page-crawler/workflows/Tests/badge.svg)
[![Test Coverage](https://api.codeclimate.com/v1/badges/75ae58115a911edfb178/test_coverage)](https://codeclimate.com/github/nadar/crawler/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/75ae58115a911edfb178/maintainability)](https://codeclimate.com/github/nadar/crawler/maintainability)
[![Packagist Downloads](https://img.shields.io/packagist/dt/nadar/crawler)](https://packagist.org/packages/nadar/crawler)

A highly extendible, dependency free Crawler for HTML, PDFS or any other type of Documents.

**Why another Page Crawler?** Yes, indeed, there are already very good Crawlers around, therefore those where my goals:

+ **Dependency Free** - we don't want to use any HTTP client, as much PHP "native" code as possible in order to keep the overhead as small. It just requires CURL
+ **Memory Efficent** - As memory efficient as possible, less overhead, full code control.
+ **Extendible** - Attach your own parsers in order to determine how html or any other format is parsed. We provided out of the box support for HTML and PDF.
+ **Runtime Storage** - When the parers run, certain informations must be stored. This is extendible to suit your use case. Either use your database or take the built int array or file storage system.
+ **Async** - It's possible to start the crawler and process any further run cycle in an asynchronus process.


## Installation

```
composer require nadar/crawler
```

## Usage

Create your handler, this is the classes which will interact with the crawler in order to store your content/results somwehere. The afterRun() method will run whenever a url is crawled and contain the results:

```php
class MyCrawlHandler implements \Nadar\Crawler\Interfaces\HandlerInterface
{
    public function afterRun(\Nadar\Crawler\Result $result)
    {
        echo $result->title . " with content " . $result->content . " for url " . $result->url->getNormalized();
    }
    
    public function onSetup(Crawler $crawler)
    {
        // do some stuff before the crawler runs, maybe truncate your temporary table where the results should be stored.
    }
    
    public function onEnd(Crawler $crawler)
    {
        // runs when the crawler is finished, maybe synchronize your temporary index table with the "real" site index.
    }

}
```

The handler class within the full setup:

```php
$crawler = new Crawler('https://luya.io', new ArrayStorage, new LoopRunner);

// what kind of document types would you like to parse?
$crawler->addParser(new Nadar\Crawler\Parsers\Html);
// need pdfs, increases memory usage! 
// $crawler->addParser(new Nadar\Crawler\Parsers\Pdf);

// register your handler in order to interact with the results, maybe store them in a database?
$crawler->addHandler(new MyCrawlHandler);

// setup and start the crawl process
$crawler->setup();
$crawler->run();
```

## Benchmark

Of course those benchmarks may vary depending on internet connection, bandwidth, servers but we made all the tests under the same circumstances. The memory peak varys strong when using the PDF parsers, therefore we test only with HTML parser

| Index Size     | Concurrent Requests    | Memory Peak     |Time               | Storage
|-------------- |-------------------    |-----------        |----               | ---
| 308              | 30                    | 6MB               | 19s               | ArrayStorage
| 308              | 30                    | 6MB               | 20s               | FileStorage


> The benchmark website is https://demo.luya.io/, Looking for a better "static" website to benchmark... not finished here


This is the example benchmark setup:

```php
use Nadar\Crawler\Crawler;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Parsers\PdfParser;

include 'vendor/autoload.php';

$crawler = new Crawler('.........YOUR_WEBSITE........', new ArrayStorage, new LoopRunner);
$crawler->addParser(new HtmlParser);
$crawler->addParser(new PdfParser);
$crawler->addHandler(new DebugHandler());
$crawler->setup();
$crawler->run();
```

## Developer Informations

For a better understanding, here is en explenation of how the classes are capsulated and for what they are used.

+ Crawler: The Crawler is the main programm, it starts, runs and ends.
+ Job: The job contains the url logic for the next "CURL"/Download Job
+ Parsers: The parsers will take the job informations in combination with the RequestResponse in order to generate a ParserResult
+ ParserResult: The Job result represents the result from a Parser.
+ QueueItem: The queue item is extract from the job and is only used to store those informations with use of StorageInterface


Crawler -> Job -> (ItemQueue -> Storage) -> RequestResponse -> Parser -> ParserResult -> Result
