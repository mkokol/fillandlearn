<?php
namespace AppBundle\Controller\VocabularyWords;

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
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/words/",
     *      name="vocabulary_words",
     *      defaults={"sheetId" = null}
     * )
     * @ParamConverter(name="sheet", class="AppBundle:Sheet")
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyWords/View:get.html.twig")
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