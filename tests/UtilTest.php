<?php

namespace duncan3dc\BomTests;

use duncan3dc\Bom\Util;
use PHPUnit\Framework\TestCase;
use function file_get_contents;

class UtilTest extends TestCase
{

    public function fileProvider(): \Generator
    {
        foreach (glob(__DIR__ . "/files/*.csv") as $filename) {
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

        # The file with a bom we want to remove
        $contents = file_get_contents($filename);

        # Attempt to remove the bom
        $string = Util::removeBom($contents);

        # Check that the file's contents now match our clean UTF-8 file
        $this->assertSame($expected, $string);
    }
}
