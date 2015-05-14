<?php
namespace AppBundle\Controller\Learn;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RememberController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/remember/all",
     *      name="remember_word_all"
     * )
     * @Template("AppBundle:Learn/Remember:get.html.twig")
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
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/remember/new",
     *      name="remember_word_new_and_not_passed"
     * )
     * @Template("AppBundle:Learn/Remember:get.html.twig")
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
