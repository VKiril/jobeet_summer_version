<?php

namespace Ibw\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Swift_Message;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IbwJobeetBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('IbwJobeetBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    public function sendMailAction(){

        $a = 1 ;
        try{
            $message = Swift_Message::newInstance()
                ->setSubject('Contact enquiry from symblog')
                ->setFrom('vasiltia.chiril@gmail.com')
                ->setTo('everest0corp@gmail.com')
                ->setBody($this->renderView('IbwJobeetBundle:Default:mail.txt.twig' ));

            $this->get('mailer')->send($message);
        } catch(Exception $e){
            print_r($e->getMessage());
        }

        //$this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you mf!');

        // Redirect - This is important to prevent users re-posting
        // the form if they refresh the page
        return $this->redirect($this->generateUrl('ibw_job'));
    }

    public function changeLanguageAction()
    {
        $language = $this->container->get('request_stack')->getCurrentRequest()->get('language');
        return $this->redirect($this->generateUrl('ibw_job', array('_locale' => $language)));
    }
}
