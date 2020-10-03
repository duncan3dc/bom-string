# bom-string
A small PHP library to handle byte order marks (BOM)

[![release](https://poser.pugx.org/duncan3dc/bom-string/version.svg)](https://packagist.org/packages/duncan3dc/bom-string)
[![build](https://github.com/duncan3dc/bom-string/workflows/.github/workflows/buildcheck.yml/badge.svg?branch=master)](https://github.com/duncan3dc/bom-string/actions?query=branch%3Amaster+workflow%3A.github%2Fworkflows%2Fbuildcheck.yml)
[![coverage](https://codecov.io/gh/duncan3dc/bom-string/graph/badge.svg)](https://codecov.io/gh/duncan3dc/bom-string)


## Installation

The recommended method of installing this library is via [Composer](//getcomposer.org/).

Run the following command from your project root:

```bash
$ composer require duncan3dc/bom-string
```


## Usage

Remove the BOM from a string and get back a clean UTF-8 string
```php
use duncan3dc\Bom\Util;

$string = Util::removeBom($bomString);
```


There's also a stream filter available:
```php
use duncan3dc\Bom\StreamFilter;

stream_filter_register("bom-filter", StreamFilter::class);

$file = fopen($filename, "r");

stream_filter_append($file, "bom-filter");

while ($row = fgetcsv($file)) {
    print_r($row);
}

fclose($file);
```


## Changelog
A [Changelog](CHANGELOG.md) has been available since the beginning of time


## Where to get help
Found a bug? Got a question? Just not sure how something works?  
Please [create an issue](//github.com/duncan3dc/bom-string/issues) and I'll do my best to help out.  
Alternatively you can catch me on [Twitter](https://twitter.com/duncan3dc)


## duncan3dc/bom-string for enterprise

Available as part of the Tidelift Subscription

The maintainers of duncan3dc/bom-string and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-duncan3dc-bom-string?utm_source=packagist-duncan3dc-bom-string&utm_medium=referral&utm_campaign=readme)
