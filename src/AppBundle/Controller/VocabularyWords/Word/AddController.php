<?php

namespace AppBundle\Controller\VocabularyWords\Word;

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
     * @Route("/vocabulary/{vocabularyId}/word/add/", name="vocabulary_word_add")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction($vocabularyId)
    {
        $word = new Word();
        $word->addTranslation(new Translation());
        $form = $this->createForm('word', $word, [
            'action' => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabularyId
            ])
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/vocabulary/{vocabularyId}/word/add/", name="vocabulary_word_add_post")
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyWords/Word/Add:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary)
    {
        $word = new Word();
        $word->setLanguage($vocabulary->getPrimaryLanguage());
//        $translation = new Translation();
//        $translation->setLanguage($vocabulary->getSecondaryLanguage());
//        $word->addTranslation($translation);
        $form = $this->createForm('word', $word, [
            'action' => $this->generateUrl('vocabulary_word_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId()
            ])
        ]);
        $form->handleRequest($request);
        foreach($word->getTranslations() as $translation){
            $translation->setLanguage($vocabulary->getSecondaryLanguage());
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            $em->persist($word);



            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
