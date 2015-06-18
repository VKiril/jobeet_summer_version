<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 22.05.2015
 * Time: 11:38
 */
namespace  Ibw\JobeetBundle\Utils\Jobeet;

class Jobeet {

    public static function slugify($text)
    {
        // replace all non letters or digits by -
        $text = preg_replace('/W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }

}