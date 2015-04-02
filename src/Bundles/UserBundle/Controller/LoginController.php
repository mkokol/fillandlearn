<?php
namespace Bundles\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("", name="user_login")
     * @Template("UserBundle:Login:get.html.twig")
     * @Method({"GET"})
     */
    public function getAction()
    {

    }

    /**
     * @Route("", name="user_login_post")
     * @Template("UserBundle:Login:get.html.twig")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {

    }
}