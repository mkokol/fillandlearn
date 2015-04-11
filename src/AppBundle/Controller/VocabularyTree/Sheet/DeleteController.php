<?php

namespace AppBundle\Controller\VocabularyTree\Sheet;

use AppBundle\Entity\Sheet;
use AppBundle\Entity\Vocabulary;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteController extends Controller
{
    /**
     * @Route("/vocabulary/{vocabularyId}/sheet/delete/{sheetId}/", name="sheet_delete")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @ParamConverter("sheet", class="AppBundle:Sheet")
     * @Method({"DELETE"})
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Vocabulary $vocabulary, Sheet $sheet)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($sheet);
        $em->flush();

        return $this->redirect(
            $this->generateUrl(
                'vocabulary_view',
                ['vocabularyId' => $vocabulary->getVocabularyId()]
            )
        );
    }
}
