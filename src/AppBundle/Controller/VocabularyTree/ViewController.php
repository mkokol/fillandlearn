<?php
namespace AppBundle\Controller\VocabularyTree;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\Vocabulary;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/tree/",
     *      name="vocabulary_tree",
     *      defaults={"sheetId" = null}
     * )
     * @ParamConverter("entity", class="AppBundle:Vocabulary")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @Template("AppBundle:VocabularyTree/View:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary, Sheet $sheet = null)
    {
        return [
            'vocabulary' => $vocabulary,
            'sheet'      => $sheet
        ];
    }
}