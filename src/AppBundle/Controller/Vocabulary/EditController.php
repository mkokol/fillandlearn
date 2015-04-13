<?php

namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vocabulary;

class EditController extends Controller
{
    /**
     * @Route("/edit/{vocabularyId}/", name="vocabulary_edit")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:Vocabulary/Edit:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary)
    {
        $form = $this->createForm('vocabulary', $vocabulary, [
            'action' => $this->generateUrl(
                'vocabulary_edit_post',
                ['vocabularyId' => $vocabulary->getVocabularyId()]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/edit/{vocabularyId}/", name="vocabulary_edit_post")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:Vocabulary/Edit:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary)
    {
        $form = $this->createForm('vocabulary', $vocabulary, [
            'action' => $this->generateUrl(
                'vocabulary_edit_post',
                ['vocabularyId' => $vocabulary->getVocabularyId()]
            )
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
