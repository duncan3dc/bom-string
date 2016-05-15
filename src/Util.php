<?php

namespace duncan3dc\Bom;

class Util
{
    const UTF8 = "\xEF\xBB\xBF";
    const UTF16BE = "\xFE\xFF";
    const UTF16LE = "\xFF\xFE";

    public static function removeBom($string)
    {
        # Check for the UTF-8 byte order mark
        if (substr($string, 0, 3) === self::UTF8) {
            # If we found the bom then the file is already UTF-8 so just remove the bom
            return substr($string, 3);
        }

        # Check for the UTF-16 big endian byte order mark
        if (substr($string, 0, 2) === self::UTF16BE) {
            # If we found the bom then remove it and convert the data from UTF-16 to UTF-8
            $string = substr($string, 2);
            $string = mb_convert_encoding($string, "UTF-8", "UTF-16BE");
            return $string;
        }

        # Check for the UTF-16 little endian byte order mark
        if (substr($string, 0, 2) === self::UTF16LE) {
            # If we found the bom then remove it and convert the data from UTF-16 to UTF-8
            $string = substr($string, 2);
            $string = mb_convert_encoding($string, "UTF-8", "UTF-16LE");
            return $string;
        }

        return $string;
    }
}
