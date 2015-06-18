<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 22.05.2015
 * Time: 13:41
 */

namespace Ibw\JobeetBundle\Utils\Messages\Base;


abstract class Response {
    private $statusCode;
    private $message;

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function setStatusCode($statusCode){
        $this->statusCode = $statusCode;
    }

    abstract public function setMessage($message);
    abstract public function getMessage();
}