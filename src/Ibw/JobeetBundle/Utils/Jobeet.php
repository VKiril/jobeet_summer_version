<?php


namespace Ibw\JobeetBundle\Utils;



/**
 * // transliterate remained
 */
class Jobeet
{
    static public function slugify($text)
    {
        //delete first position space and last position spaces, the rest of all will be replaced with hyphen ("-")
        $buff = explode(" ", $text);
        $text = implode("-", $buff);
        // replace all non letters or digits by -
        $text = preg_replace("/[^[:alpha:]0-9 ]/", '-', $text);

        // replace non letter or digits by -
        //$text = preg_replace('#[^\pLd]+#u', '-', $text);

        // transliterate
        if (function_exists('iconv'))
        {
            $text = @iconv("utf-8", "us-ascii//TRANSLIT", $text);
        }

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        // remove unwanted characters
        //$text = preg_replace('#[^-w]+#', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;

        /*// replace non letter or digits by -
        $text = preg_replace('#[^\pLd]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;*/
    }
}