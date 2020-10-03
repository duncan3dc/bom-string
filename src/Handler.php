<?php

namespace duncan3dc\Bom;

use function mb_convert_encoding;
use function substr;

class Handler
{
    private const UNKNOWN = "";
    private const UTF8 = "\xEF\xBB\xBF";
    private const UTF16BE = "\xFE\xFF";
    private const UTF16LE = "\xFF\xFE";

    /**
     * @var string $encoding The encoding that the data we're handling is in.
     */
    private $encoding;


    /**
     * Get the encoding of a BOM declared string, and remove the bom.
     *
     * @param string $string The data to examine
     *
     * @return string The encoding of the string
     */
    private function getEncoding(string &$string): string
    {
        # Check for the UTF-8 byte order mark
        if (substr($string, 0, 3) === self::UTF8) {
            $string = substr($string, 3);
            return self::UTF8;
        }

        # Check for the UTF-16 big endian byte order mark
        if (substr($string, 0, 2) === self::UTF16BE) {
            $string = substr($string, 2);
            return self::UTF16BE;
        }

        # Check for the UTF-16 little endian byte order mark
        if (substr($string, 0, 2) === self::UTF16LE) {
            $string = substr($string, 2);
            return self::UTF16LE;
        }

        return self::UNKNOWN;
    }


    /**
     * Read some data, remove any BOM found, and convert to UTF-8.
     *
     * @param string $string The data to read/convert
     *
     * @return string
     */
    public function convert(string $string): string
    {
        if ($this->encoding === null) {
            $this->encoding = $this->getEncoding($string);
        }

        if ($this->encoding === self::UTF16BE) {
            $string = mb_convert_encoding($string, "UTF-8", "UTF-16BE");
        }

        if ($this->encoding === self::UTF16LE) {
            $string = mb_convert_encoding($string, "UTF-8", "UTF-16LE");
        }

        return $string;
    }
}
