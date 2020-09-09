# Website Crawler for PHP

![Tests](https://github.com/nadar/php-page-crawler/workflows/Tests/badge.svg)
[![Test Coverage](https://api.codeclimate.com/v1/badges/75ae58115a911edfb178/test_coverage)](https://codeclimate.com/github/nadar/crawler/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/75ae58115a911edfb178/maintainability)](https://codeclimate.com/github/nadar/crawler/maintainability)

A highly extendible, dependency free Crawler for HTML, PDFS or any other type of Documents.

**Why another Page Crawler?** Yes, indeed, there are already very good parsers around but this parsers should:

+ Dependency Free - we don't want to use any HTTP client, as much PHP "native" code as possible in order to keep the overhead as small as possible
+ Memory Efficent - As memory efficient as possible, less overhead, full code control.
+ Extendible - Attach your own parsers in order to determine how html or any other format is parsed. We provided out of the box support for HTML and PDF.
+ Runtime Storage - When the parers run, certain informations must be stored. This is extendible to suite your database or use our built int array or file storage system
+ Async - It's possible to start the crawler and process any further run cycle in an asynchronus process


## Installation

```
composer require nadar/crawler
```

## Usage

Create your custom handler, this is the classes which will interact with the crawler in order to store your content somwehere. This function will run after each url is crawled:

```php
class MyCrawlHandler implements \Nadar\Crawler\Interfaces\HandlerInterface
{
    public function afterRun(\Nadar\Crawler\Result $result)
    {
        echo $result->title;
    }
}
```

The handler class within the full setup:

```php
$crawler = new Crawler('https://luya.io', new ArrayStorage, new LoopRunner);

// what kind of document types would you like to parse?
$crawler->registerParser(new Nadar\Crawler\Parsers\Html);

// register your handler in order to interact with the results, maybe store them in a database?
$crawler->registerHandler(new MyCrawlHandler);

// start the crawling
$crawler->run();
```

## Benchmark

Of course those benchmarks may vary depending on internet connection, bandwidth, servers but we made all the tests under the same circumstances. The memory peak varys strong when using the PDF parsers.

| Index Size     | Concurrent Requests    | Memory Peak     |Time               | Storage
|-------------- |-------------------    |-----------        |----               | ---
| 3785          | 15                    | 18 MB             | 260 Seconds       | Array
| 1509          | 30                    | 97 MB             | 225 Seconds       | Array
| 1374          | 30                    | 269 MB            | 87 Seconds        | Array

> The benchmark website is https://demo.luya.io/


This is the example benchmark setup:

```php
use Nadar\Crawler\Crawler;
use Nadar\Crawler\Handlers\DebugHandler;
use Nadar\Crawler\Parsers\HtmlParser;
use Nadar\Crawler\Parsers\PdfParser;

include 'vendor/autoload.php';

$handler = new DebugHandler();

$crawler = new Crawler('.........YOUR_WEBSITE........', new ArrayStorage, new LoopRunner);
$crawler->addParser(new HtmlParser);
$crawler->addParser(new PdfParser);
$crawler->addHandler($handler);
$crawler->setup();
$crawler->run();

echo "==================" . PHP_EOL;
echo "URLs: " . ($handler->counter) . PHP_EOL;
echo "time: " . ($handler->elapsedTime()) . PHP_EOL;
echo "peak: " . $handler->memoryPeak() . PHP_EOL;
```

## Developer Informations

For a better understanding, here is en explenation of how the classes are capsulated and for what they are used.

+ Crawler: The Crawler is the main programm, it starts, runs and ends.
+ Job: The job contains the url logic for the next "CURL"/Download Job
+ Parsers: The parsers will take the job informations in combination with the RequestResponse in order to generate a JobResult
+ JobResult: The Job result represents the result from a Parser.
+ QueueItem: The queue item is extract from the job and is only used to store those informations with use of StorageInterface


Crawler -> Job -> (ItemQueue -> Storage) -> RequestResponse -> Parser -> JobResult -> Result