<?php

namespace AppBundle\Controller\VocabularyTree\Folder;

use AppBundle\Entity\Folder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Vocabulary;

class AddController extends Controller
{
    /**
     * @Route("/{vocabularyId}/folder/add/", name="folder_add")
     * @Template("AppBundle:VocabularyTree/Folder/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction($vocabularyId)
    {
        $folder = new Folder();
        $form = $this->createForm('folder', $folder, [
            'action' => $this->generateUrl('folder_add_post', [
                'vocabularyId' => $vocabularyId
            ])
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{vocabularyId}/folder/add/", name="folder_add_post")
     * @ParamConverter(name="vocabulary", class="AppBundle:Vocabulary")
     * @Template("AppBundle:VocabularyTree/Folder/Add:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary)
    {
        $folder = new Folder();
        $folder->setVocabulary($vocabulary);
        $form = $this->createForm('folder', $folder, [
            'action' => $this->generateUrl('folder_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId()
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($folder);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}
