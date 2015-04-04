<?php
namespace Bundles\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LogoutController extends Controller
{
    /**
     * @Route("/", name="user_logout")
     * @Template("UserBundle:Login:post.html.twig")
     * @Method({"GET"})
     */
    public function getAction()
    {
        return [];
    }
}