<?php
namespace AppBundle\Controller\Vocabulary;

use AppBundle\Entity\Sheet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Vocabulary;

class ViewController extends Controller
{
    /**
     * @Route(
     *      "/{vocabularyId}/",
     *      name="vocabulary_view",
     *      defaults={"sheetId" = null}
     * )
     * @Route(
     *      "/{vocabularyId}/sheet/{sheetId}",
     *      name="vocabulary_sheet_view"
     * )
     * @Template("AppBundle:Vocabulary/View:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction($vocabularyId, $sheetId)
    {
        return [
            'vocabularyId' => $vocabularyId,
            'sheetId'      => $sheetId
        ];
    }
}
