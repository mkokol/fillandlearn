<?php

namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vocabulary;

class AddController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/add/", name="vocabulary_add")
     * @Template("AppBundle:Vocabulary/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction()
    {
        $vocabulary = new Vocabulary();
        $vocabulary->setUser($this->getUser());
        $form = $this->createForm('vocabulary', $vocabulary, [
            'action' => $this->generateUrl('vocabulary_add_post')
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     *
     * @Route("/add/", name="vocabulary_add_post")
     * @Template("AppBundle:Vocabulary/Add:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request)
    {
        $vocabulary = new Vocabulary();
        $vocabulary->setUser($this->getUser());
        $form = $this->createForm('vocabulary', $vocabulary, [
            'action' => $this->generateUrl('vocabulary_add_post')
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($vocabulary);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
