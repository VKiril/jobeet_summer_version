<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17.06.2015
 * Time: 16:51
 */

namespace Ibw\JobeetBundle\Utils\Messages;


use Ibw\JobeetBundle\Utils\Messages\Base\Response;

class Error extends Response
{
    public $message ;

    public function __construct($message, $statusCode = 400)
    {
        $this->message = $message ;
        $this->setStatusCode($statusCode);
    }

    public function setMessage($message)
    {
        $this->message = $message ;

        return $this;
    }

    public function getMessage()
    {
        return array("error"=>true, "content"=>$this->message);
    }
}