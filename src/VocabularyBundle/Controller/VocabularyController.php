<?php

namespace VocabularyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VocabularyController extends Controller
{
    /**
     * @Route("", name="vocabulary")
     * @Template("VocabularyBundle:Vocabulary:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        return [];
    }
}
