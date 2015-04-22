<?php
namespace AppBundle\Controller\Vocabulary;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Vocabulary;

class DeleteController extends Controller
{
    /**
     * @Route(
     *      "/delete/{vocabularyId}/",
     *      name="vocabulary_delete"
     * )
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @Method({"DELETE"})
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Vocabulary $vocabulary)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($vocabulary);
        $em->flush();

        return $this->redirect($this->generateUrl('vocabulary'));
    }
}
