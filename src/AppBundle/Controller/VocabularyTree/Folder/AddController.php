<?php

namespace AppBundle\Controller\VocabularyTree\Folder;

use AppBundle\Entity\Folder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @param Request $request
     *
     * @Route("/{vocabularyId}/folder/add/", name="folder_add")
     * @Template("AppBundle:VocabularyTree/Folder/Add:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary)
    {
        $folder = new Folder();
        $form = $this->createForm('folder', $folder, [
            'action' => $this->generateUrl('folder_add_post', [
                'vocabularyId' => $vocabulary->getVocabularyId()
            ])
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     *
     * @Route("/{vocabularyId}/folder/add/", name="folder_add_post")
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
