# php-page-crawler

A simple Page Crawler Implementation written in PHP

## Installation

## Usage

Create your custom handler, this is the classes which will interact with the crawler in order to store your content somwehere.

```php
class MyCrawlHandler implements \Nadar\PageCrawler\HandlerInterface
{
    public function beforeRun()
    {

    }

    public function afterRun(\nadar\PageCrawler\Result $result)
    {
        echo $result->title;
    }
}
```

```php
$crawler = new Crawler('https://luya.io');
$crawler->registerHandler(MyCrawlHandler::class);
$crawler->run();
```