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
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm('user_login');
        $form["email"]->setData($authenticationUtils->getLastUsername());

        return [
            'error' => $error,
            'form'  => $form->createView()
        ];
    }

    /**
     * @Route("/", name="user_login_post")
     * @Template("UserBundle:Login:post.html.twig")
     * @Method({"POST"})
     */
    public function postAction()
    {
        return [];
    }
}