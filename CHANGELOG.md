# CHANGELOG

All notable changes to this project will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).
In order to read more about upgrading and BC breaks have a look at the [UPGRADE Document](UPGRADE.md).

## 1.2.1 (17. December 2020)

+ [#9](https://github.com/nadar/crawler/pull/9) Fix issue where `CRAWL_IGNORE` tag had no effect. Trim the value of a links.

## 1.2.0 (14. November 2020)

+ [#7](https://github.com/nadar/crawler/pull/7/files) By default, response content which is bigger then 5MB won't be passed to Parsers. In order to turn off this behavior use `'maxSize' => false` or increase the limit `'maxSize' => 15000000` (which is 15MB for example). The value must be provided in Bytes. The main goal is to ensure that the PDF Parser won't run into very large memory consumption. This restriction won't stop the Crawler from downloading the URL (whether its large the the maxSize definition or not), but preventing memory leaks when the Parsers start to interact with the response content.

## 1.1.2 (12. November 2020)

+ Decrease the CURL Request Timeout. A CURL request for a given URL will now timeout after 5 seconds.

## 1.1.1 (21. October 2020)

+ [#5](https://github.com/nadar/crawler/pull/5) Fix a bug with not done function `isValid` to check whether an url is a mailto link or similar.

## 1.1.0 (21. October 2020)

+ [#4](https://github.com/nadar/crawler/pull/4) Add option to encode the url paths.

## 1.0.0 (25. September 2020)

- First stable release.
