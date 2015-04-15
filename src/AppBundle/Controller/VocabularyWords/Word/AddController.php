<?php

namespace AppBundle\Controller\VocabularyWords\Word;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\SheetWordReference;
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
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction($vocabularyId, $sheetId)
    {
        $word = new Word();
        $word->addTranslation(new Translation());
        $form = $this->createForm('word', $word, [
            'action' => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabularyId,
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
        $word = new Word();
        $word->setLanguage($vocabulary->getPrimaryLanguage());
        $form = $this->createForm('word', $word, [
            'action' => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId(),
                'sheetId'      => $sheet->getSheetId()
            ])
        ]);
        $form->handleRequest($request);

        foreach ($word->getTranslations() as $translation) {
            $translation->setLanguage($vocabulary->getSecondaryLanguage());
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($word);
            $em->flush();

            $sheetWordReference = new SheetWordReference();
            $sheetWordReference->setWord($word);
            $sheetWordReference->setSheet($sheet);
            $em->persist($sheetWordReference);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
