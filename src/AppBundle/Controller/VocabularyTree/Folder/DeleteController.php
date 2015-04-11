<?php

namespace AppBundle\Controller\VocabularyTree\Folder;

use AppBundle\Entity\Folder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteController extends Controller
{
    /**
     * @Route("/vocabulary/{vocabularyId}/folder/delete/{folderId}/", name="folder_delete")
     * @ParamConverter("folder", class="AppBundle:Folder")
     * @Method({"DELETE"})
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Folder $folder, $vocabularyId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($folder);
        $em->flush();

        return $this->redirect(
            $this->generateUrl(
                'vocabulary_view',
                ['vocabularyId' => $vocabularyId]
            )
        );
    }
}
