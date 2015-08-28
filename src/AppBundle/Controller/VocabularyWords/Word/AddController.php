<?php

namespace AppBundle\Controller\VocabularyWords\Word;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\SheetWord;
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

class AddController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/word/add/",
     *      name="vocabulary_word_add"
     * )
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary, $sheetId)
    {
        $word = new Word();
        $word->addTranslation(new Translation());
        $form = $this->createForm('word', $word, [
            'action' => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId(),
                'sheetId'      => $sheetId
            ])
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/word/add/",
     *      name="vocabulary_word_add_post"
     * )
     * @ParamConverter(name="sheet", class="AppBundle:Sheet")
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary, Sheet $sheet)
    {
        $sheetWord = new SheetWord();
        $sheetWord->setSheet($sheet);

        $form = $this->createForm('word', new Word(), [
            'action'     => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId(),
                'sheetId'      => $sheet->getSheetId()
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
