<?php

namespace duncan3dc\Bom;

class Util
{

    /**
     * Remove a BOM from a file contents and convert to UTF-8.
     *
     * @param string $string The file contents to convert
     *
     * @param string
     */
    public static function removeBom($string)
    {
        $handler = new Handler;

        return $handler->convert($string);
    }
}
