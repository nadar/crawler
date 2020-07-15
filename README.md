# Page Crawler

![Tests](https://github.com/nadar/php-page-crawler/workflows/Tests/badge.svg)

A simple Page Crawler Implementation written in PHP



## Installation

## Usage

Create your custom handler, this is the classes which will interact with the crawler in order to store your content somwehere.

```php
class MyCrawlHandler implements \Nadar\PageCrawler\HandlerInterface
{
    public function afterRun(\Nadar\PageCrawler\Result $result)
    {
        echo $result->title;
    }
}
```

```php
$crawler = new Crawler('https://luya.io');
$crawler->registerHandler(new MyCrawlHandler);
$crawler->run();
```