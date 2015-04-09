<?php

namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VocabularyListController extends Controller
{
    /**
     * @Route("/", name="vocabulary")
     * @Template("AppBundle:Vocabulary/VocabularyList:get.html.twig")
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
