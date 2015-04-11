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

class EditController extends Controller
{
    /**
     * @param Vocabulary $vocabulary
     * @param Sheet $sheet
     * @return array
     *
     * @Route("/vocabulary/{vocabularyId}/sheet/edit/{sheetId}/", name="sheet_edit")
     * @Template("AppBundle:VocabularyTree/Sheet/Edit:get.html.twig")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary, Sheet $sheet)
    {
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'sheet_edit_post',
                [
                    'vocabularyId' => $vocabulary->getVocabularyId(),
                    'sheetId'      => $sheet->getSheetId()
                ]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     * @param Vocabulary $vocabulary
     * @param Sheet $sheet
     * @return mixed
     *
     * @Route("/vocabulary/{vocabularyId}/sheet/edit/{sheetId}/", name="sheet_edit_post")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyTree/Sheet/Edit:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary, Sheet $sheet)
    {
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'sheet_edit_post',
                [
                    'vocabularyId' => $vocabulary->getVocabularyId(),
                    'sheetId'      => $sheet->getSheetId()
                ]
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
