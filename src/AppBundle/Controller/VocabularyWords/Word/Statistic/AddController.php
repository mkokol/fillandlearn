<?php

namespace AppBundle\Controller\VocabularyWords\Word\Statistic;

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
use VocabularyBuilder\Learning\Statistic;

class AddController extends Controller
{
    /**
     * @Route(
     *      "/sheet-word/{sheetWordId}/status/{status}/add/",
     *      name="sheet_word_status_add_post"
     * )
     * @ParamConverter(name="sheetWord", class="AppBundle:SheetWord")
     * @Method({"POST", "GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(SheetWord $sheetWord, $status)
    {
        $statistic = $sheetWord->getStatistic();
        $statistic->updatePracticeStatus($status);
        $sheetWord->setTranslationStatistic($statistic->getCurrentTranslationStatistic());
        $sheetWord->setStatistic($statistic);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($sheetWord);
        $em->flush();

        return new JsonResponse(['status' => 'success']);
    }
}
