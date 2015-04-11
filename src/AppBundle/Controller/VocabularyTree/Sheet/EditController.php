<?php

namespace AppBundle\Controller\VocabularyTree\Sheet;

use AppBundle\Entity\Sheet;
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
     * @param int $vocabularyId
     * @param Sheet $sheet
     * @return array
     *
     * @Route("/vocabulary/{vocabularyId}/sheet/edit/{sheetId}/", name="sheet_edit")
     * @Template("AppBundle:VocabularyTree/Sheet/Edit:get.html.twig")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Sheet $sheet, $vocabularyId)
    {
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'sheet_edit_post',
                [
                    'vocabularyId' => $vocabularyId,
                    'sheetId'      => $sheet->getSheetId()
                ]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     * @param Sheet $sheet
     * @param int $vocabularyId
     * @return mixed
     *
     * @Route("/vocabulary/{vocabularyId}/sheet/edit/{sheetId}/", name="sheet_edit_post")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyTree/Sheet/Edit:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Sheet $sheet, $vocabularyId)
    {
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'sheet_edit_post',
                [
                    'vocabularyId' => $vocabularyId,
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
