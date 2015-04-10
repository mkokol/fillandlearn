<?php

namespace AppBundle\Controller\VocabularyTree\Sheet;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\Vocabulary;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddToVocabularyController extends Controller
{
    /**
     * @param Vocabulary $vocabulary
     * @return array
     *
     * @Route("/sheet/add/vocabulary/{vocabularyId}/", name="vocabulary_sheet_add")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyTree/Sheet/AddTo:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary)
    {
        $sheet = new Sheet();
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'vocabulary_sheet_add_post',
                ['vocabularyId' => $vocabulary->getVocabularyId()]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * @Route("/sheet/add/vocabulary/{vocabularyId}/", name="vocabulary_sheet_add_post")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyTree/Sheet/AddTo:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary)
    {
        $sheet = new Sheet();
        $sheet->setVocabulary($vocabulary);
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'vocabulary_sheet_add_post',
                ['vocabularyId' => $vocabulary->getVocabularyId()]
            )
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($sheet);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
