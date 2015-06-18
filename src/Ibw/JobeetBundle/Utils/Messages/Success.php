<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17.06.2015
 * Time: 16:51
 */

namespace Ibw\JobeetBundle\Utils\Messages;

use Ibw\JobeetBundle\Utils\Messages\Base\Response;

class Success extends Response
{
    private $message ;

    public function __construct($message, $status_code = 200)
    {
        $this->message = $message ;
        $this->setStatusCode($status_code);
    }

    public function setMessage($message)
    {
        $this->message = $message ;

        return $this;
    }

    public function getMessage()
    {
        return ["error"=>false, "content"=>$this->message];
    }
}