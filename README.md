# bom-string
A small PHP library to handle byte order marks (BOM)

[![Build Status](https://img.shields.io/travis/duncan3dc/bom-string.svg)](https://travis-ci.org/duncan3dc/bom-string)
[![Latest Version](https://img.shields.io/packagist/v/duncan3dc/bom-string.svg)](https://packagist.org/packages/duncan3dc/bom-string)


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
