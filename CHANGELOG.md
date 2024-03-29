# CHANGELOG

All notable changes to this project will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).
In order to read more about upgrading and BC breaks have a look at the [UPGRADE Document](UPGRADE.md).

## 1.7.1 (5. April 2022)

+ Added catch for throwable when parsing pdfs, also updated to latest version of `smalot/pdfparser`.

## 1.7.0 (10. August 2021)

+ [#20](https://github.com/nadar/crawler/pull/20) Improve the strip tags for html parser in order to generate a more clean and readable output when `$stripTags` is enabled. Things like `<p>foo</p><p>bar</p>` are now handled as `foo bar` instead of `foobar`.

## 1.6.2 (16. April 2021)

+ [#18](https://github.com/nadar/crawler/pull/18) Fix issue with pages where utf8 chars are in title tag.

## 1.6.1 (16. April 2021)

+ [#17](https://github.com/nadar/crawler/pull/17) Fixed issue where crawler group is not generated correctly.

## 1.6.0 (16. March 2021)

+ [#15](https://github.com/nadar/crawler/issues/15) Do not follow links which have `rel="nofollow"` by default. This can be configured in the `HtmlParser::$ignoreRels` property.

## 1.5.0 (13. January 2021)

+ [#14](https://github.com/nadar/crawler/pull/14) Pass the StatusCode of the response into the parsers and process only HTML and PDFs with code 200 (OK).

## 1.4.0 (13. January 20201

+ [#13](https://github.com/nadar/crawler/pull/13) New Crawler method `getCycles()` returns the number of times the `run()` method was called.

## 1.3.0 (20. December 2020)

+ [#10](https://github.com/nadar/crawler/issues/10) Add relative url check to `Url` class.
+ [#8](https://github.com/nadar/crawler/issues/8) Merge the path of an url when only a query param is provided.

## 1.2.1 (17. December 2020)

+ [#9](https://github.com/nadar/crawler/pull/9) Fix issue where `CRAWL_IGNORE` tag had no effect. Trim the array value for found linkes, which is equals to the link title.

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
