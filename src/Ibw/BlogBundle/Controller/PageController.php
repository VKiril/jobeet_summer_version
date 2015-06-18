<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 16.06.2015
 * Time: 20:43
 */

namespace Ibw\BlogBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;

use Ibw\BlogBundle\Controller\Helper\ViewHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ibw\JobeetBundle\Utils\Messages\Error;
use Ibw\JobeetBundle\Utils\Messages\Success;
use Ibw\JobeetBundle\Utils\Messages\ErrorMessages;

class PageController extends FOSRestController {


    /**
     *
     * @ApiDoc(
     *  section="User",
     *  output = "Ibw\BlogBundle\Entity\Page",
     *  parameters={
     *      {"name"="firstName", "dataType"="string", "required"=false, "description"="The desired first name for the user"},
     *      {"name"="lastName", "dataType"="string", "required"=false, "description"="The desired last name for the user"}
     *  },
     *  resource=true,
     *  description="Update currently logged in user info",
     *  statusCodes={
     *         200="Returned when successful",
     *         400="Returned when the request sent is not right",
     *         403="Returned when the user is not logged in",
     *     }
     * )
     * @return array
     *
     * @throws NotFoundHttpException when page not exist
     *
     * POST Route annotation.
     * @Post("/user")
     */



    public function getPageAction(Request $request)
    {
        $result = $this->get("ibw.blog_bundle.requestHelper")->parseRequestAction($request, true);
       // var_dump($result);die;
        if($result instanceof Error)
            return ViewHelper::getView($result);

        return ViewHelper::getView($result);
        //die("test");
        //return $this->container->get('doctrine.entity_manager')->getRepository('Page')->find($id);
    }
}