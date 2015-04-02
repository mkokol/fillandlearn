<?php
namespace Bundles\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LogoutController extends Controller
{
    /**
     * @Route("/", name="user_logout")
     * @Template("UserBundle:Logout:get.html.twig")
     */
    public function getAction()
    {
    }
}