<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17.06.2015
 * Time: 16:56
 */

namespace Ibw\BlogBundle\Controller\Helper;

use FOS\RestBundle\View\View;
use Ibw\JobeetBundle\Utils\Messages\Base\Response;

class ViewHelper
{
    public static function getView(Response $response)
    {
        $view = View::create()
            ->setStatusCode($response->getStatusCode())
            ->setData($response->getMessage())
            ->setTemplate("IbwBlogBundle:Default:index.html.twig");

        return $view ;
    }

    public static function getViewFromPlainText($rawData)
    {
        $view = View::create()
            ->setData($rawData)
            ->setStatusCode(200)
            ->setTemplate("IbwBlogBundle:Default:index.html.twig");

        return $view ;
    }
}