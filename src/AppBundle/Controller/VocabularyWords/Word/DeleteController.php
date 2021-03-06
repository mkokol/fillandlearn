<?php

namespace AppBundle\Controller\VocabularyWords\Word;

use AppBundle\Entity\SheetWord;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteController extends Controller
{
    /**
     * @Route(
     *      "/vocabulary/{vocabularyId}/sheet/{sheetId}/word/{sheetWordId}/delete/",
     *      name="sheet_word_delete"
     * )
     * @ParamConverter(name="sheetWord", class="AppBundle:SheetWord")
     * @Method({"DELETE"})
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction($vocabularyId, $sheetId, SheetWord $sheetWord)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($sheetWord);
        $em->flush();

        return $this->redirect(
            $this->generateUrl(
                'vocabulary_sheet_view',
                [
                    'vocabularyId' => $vocabularyId,
                    'sheetId' => $sheetId
                ]
            )
        );
    }
}
