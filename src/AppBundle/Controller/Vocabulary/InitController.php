<?php
namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InitController extends Controller
{
    /**
     * @Route(
     *      "/init/",
     *      name="vocabulary_init"
     * )
     * @Template("AppBundle:Vocabulary/Init:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction()
    {
        return [];
    }
}
