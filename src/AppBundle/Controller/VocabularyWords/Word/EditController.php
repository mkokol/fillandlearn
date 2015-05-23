<?php

namespace AppBundle\Controller\VocabularyWords\Word;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\SheetWord;
use AppBundle\Entity\SheetWordTranslation;
use AppBundle\Entity\Translation;
use AppBundle\Entity\Vocabulary;
use AppBundle\Entity\Word;
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
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/word/{sheetWordId}/edit/",
     *      name="sheet_word_edit"
     * )
     *
     * @ParamConverter(name="sheetWord", class="AppBundle:SheetWord")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction($vocabularyId, $sheetId, SheetWord $sheetWord)
    {
        $form = $this->createForm('word', $sheetWord->getWord(), [
            'action' => $this->generateUrl('sheet_word_edit_post', [
                'vocabularyId' => $vocabularyId,
                'sheetId'      => $sheetId,
                'sheetWordId'  => $sheetWord->getSheetWordId()
            ]),
            'sheetWord'  => $sheetWord
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/word/{sheetWordId}/edit/",
     *      name="sheet_word_edit_post"
     * )
     * @ParamConverter(name="sheet", class="AppBundle:Sheet")
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @ParamConverter(name="sheetWord", class="AppBundle:SheetWord")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary, Sheet $sheet, SheetWord $sheetWord)
    {
        $form = $this->createForm('word', new Word(), [
            'action'     => $this->generateUrl('sheet_word_edit_post', [
                'vocabularyId' => $vocabulary->getVocabularyId(),
                'sheetId'      => $sheet->getSheetId(),
                'sheetWordId'  => $sheetWord->getSheetWordId()
            ]),
            'vocabulary' => $vocabulary,
            'sheetWord'  => $sheetWord
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var Word $word */
            $word = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($word);
            $em->flush();

            $em->persist($sheetWord);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
