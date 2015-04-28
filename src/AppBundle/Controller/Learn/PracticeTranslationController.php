<?php
namespace AppBundle\Controller\Learn;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PracticeTranslationController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/practice/translation/all",
     *      name="practice_translation_all"
     * )
     * @Template("AppBundle:Learn/PracticeTranslation:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAllAction($vocabularyId, $sheetId)
    {
        $em = $this->getDoctrine()->getManager();
        $sheetWords = $em
            ->getRepository('AppBundle:Vocabulary')
            ->getAllWords($vocabularyId, $sheetId);

        return ['sheetWords' => $sheetWords];
    }

    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/practice/translation/new",
     *      name="practice_translation_new_and_not_passed"
     * )
     * @Template("AppBundle:Learn/PracticeTranslation:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getIncorrectAction($vocabularyId, $sheetId)
    {
        $em = $this->getDoctrine()->getManager();
        $sheetWords = $em
            ->getRepository('AppBundle:Vocabulary')
            ->getAllWords($vocabularyId, $sheetId, "notPassed");

        return ['sheetWords' => $sheetWords];
    }
}
