<?php

namespace duncan3dc\Bom;

class Util
{

    /**
     * Remove a BOM from a file contents and convert to UTF-8.
     *
     * @param string $string The file contents to convert
     *
     * @return string
     */
    public static function removeBom(string $string): string
    {
        $handler = new Handler();

        return $handler->convert($string);
    }
}
