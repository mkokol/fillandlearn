<?php
namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="vocabulary"
     * )
     * @Template("AppBundle:Vocabulary/List:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vocabularies = $em->getRepository('AppBundle:Vocabulary')->findall();

        return ['vocabularies' => $vocabularies];
    }
}
