<?php

namespace DnsTools\Helpers;

use Exception;

class TextHelper
{

    public static function contains($text, $needle)
    {
        return strpos($needle, $text) !== false;
    }
    
    public static function startsWith($text, $needle) 
    {
        return substr( $text, 0, strlen($needle)) === $needle;
    }

    public static function endsWith($text, $needle) 
    {
        return substr($text, -strlen($needle))===$needle;
    }

    public static function replaceStart()
    {
        throw new Exception("Not implemented.");
        
    }

    public static function replaceEnd()
    {
        throw new Exception("Not implemented.");
    }
}
