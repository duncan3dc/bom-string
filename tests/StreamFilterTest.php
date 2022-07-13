<?php

namespace duncan3dc\BomTests;

use duncan3dc\Bom\StreamFilter;
use PHPUnit\Framework\TestCase;

use function assert;
use function fclose;
use function file_get_contents;
use function fopen;
use function fread;
use function glob;
use function is_resource;
use function stream_filter_append;
use function stream_filter_register;

class StreamFilterTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        stream_filter_register("bom-filter", StreamFilter::class);
    }


    public function fileProvider(): \Generator
    {
        $files = glob(__DIR__ . "/files/*.csv") ?: [];
        foreach ($files as $filename) {
            yield [$filename];
        }
    }


    /**
     * @dataProvider fileProvider
     */
    public function testRemoveBom(string $filename): void
    {
        # The clean UTF-8 file that we are comparing against
        $expected = file_get_contents(__DIR__ . "/files/no-bom.csv");

        $file = fopen($filename, "r");
        assert(is_resource($file));

        stream_filter_append($file, "bom-filter");

        $string = fread($file, 1024);

        fclose($file);

        # Check that the file's contents now match our clean UTF-8 file
        $this->assertSame($expected, $string);
    }
}
