<?php
namespace Bundles\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    /**
     * @Route("/", name="user_login")
     * @Template("UserBundle:Login:get.html.twig")
     * @Method({"GET"})
     */
    public function getAction()
    {
        $user = $this->getUser();
        if ($user) {
            echo $user->getEmail();
            die;
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];


//
//        $form = $this->createForm('user_login');
//
//        return [
//            'form' => $form->createView()
//        ];
    }

    /**
     * @Route("/", name="user_login_post")
     * @Method({"POST"})
     */
    public function postAction()
    {

        echo "this controller will not be executed, as the route is handled by the Security system.";
        die;

//        $authenticationUtils = $this->get('security.authentication_utils');

//        $form = $this->createForm('user_login');
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//
//            return $this->redirect(
//                $this->generateUrl('home')
//            );
//        }
//
//        return [
//            'form' => $form->createView()
//        ];
    }
}