<?php
namespace masud\Press;
use Parsedown;
class MarkdownParser
{
    /**
     * Given a markdown string, it will pass back a parsed string.
     *
     * @param $string
     *
     * @return string
     */
    public static function parse($string)
    {   
        // $parsedown = new Parsedown;
        // return $parsedown->text($string);
        return Parsedown::instance()->text($string);
    }
}