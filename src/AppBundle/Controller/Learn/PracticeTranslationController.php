<?php
namespace AppBundle\Controller\Learn;

use AppBundle\Entity\Vocabulary;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PracticeTranslationController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/practice/translation/all/",
     *      name="practice_translation_all"
     * )
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:Learn/PracticeTranslation:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAllAction(Vocabulary $vocabulary, $sheetId)
    {
        $em = $this->getDoctrine()->getManager();
        $sheetWords = $em
            ->getRepository('AppBundle:Vocabulary')
            ->getAllWords($vocabulary->getVocabularyId(), $sheetId);

        return [
            'sheetWords' => $sheetWords,
            'vocabulary' => $vocabulary
        ];
    }

    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/practice/translation/new/",
     *      name="practice_translation_new_and_not_passed"
     * )
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:Learn/PracticeTranslation:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getIncorrectAction(Vocabulary $vocabulary, $sheetId)
    {
        $em = $this->getDoctrine()->getManager();
        $sheetWords = $em
            ->getRepository('AppBundle:Vocabulary')
            ->getAllWords($vocabulary->getVocabularyId(), $sheetId, "notPassed");

        return [
            'sheetWords' => $sheetWords,
            'vocabulary' => $vocabulary
        ];
    }
}
