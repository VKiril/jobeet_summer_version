<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17.06.2015
 * Time: 16:24
 */

namespace Ibw\BlogBundle\Services;


use Ibw\JobeetBundle\Utils\Messages\Error;
use Ibw\JobeetBundle\Utils\Messages\Success;
use Symfony\Component\HttpFoundation\Request;

class RequestHelper
{
    private $entityManager;
    private $securityContext;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager, $securityContext)
    {
        $this->entityManager = $entityManager;
        $this->securityContext = $securityContext ;
    }

    public function parseRequestAction(Request $request, $checkRequestNotEmpty = true)
    {
        $rawData = $request->getContent();
        $result = json_decode($rawData, true);
        if(!isset($result['ping']))
            return new Error("missing some required parameters", 400);

        return new Success("all is ok", 200);
    }

    public function getName()
    {
        return "request_helper";
    }

}