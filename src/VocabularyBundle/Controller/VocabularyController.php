<?php

namespace VocabularyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VocabularyBundle\Entity\Vocabulary;

class VocabularyController extends Controller
{
    /**
     * @Route("/", name="vocabulary")
     * @Template("VocabularyBundle:Vocabulary:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction()
    {
        $form = $this->createForm('vocabulary');
        $em = $this->getDoctrine()->getManager();
        $vocabularies = $em->getRepository('VocabularyBundle:Vocabulary')->findall();

        return [
            'form'         => $form->createView(),
            'vocabularies' => $vocabularies
        ];
    }

    /**
     * @param Request $request
     *
     * @Route("/", name="vocabulary_post")
     * @Template("VocabularyBundle:Vocabulary:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request)
    {
        $vocabulary = new Vocabulary();
        $vocabulary->setUser($this->getUser());
        $form = $this->createForm('vocabulary', $vocabulary);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($vocabulary);
            $em->flush();
        }

        $em = $this->getDoctrine()->getManager();
        $vocabularies = $em->getRepository('VocabularyBundle:Vocabulary')->findall();

        return [
            'form'         => $form->createView(),
            'vocabularies' => $vocabularies
        ];
    }

    /**
     * @Route("/{vocabularyId}/", name="vocabulary_delete")
     * @ParamConverter("entity", class="VocabularyBundle:Vocabulary")
     * @Method({"DELETE"})
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Vocabulary $vocabulary)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($vocabulary);
        $em->flush();

        return $this->redirect($this->generateUrl('vocabulary'));
    }
}
