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

class EditController extends Controller
{
    /**
     * @param Vocabulary $vocabulary
     * @param Folder $folder
     * @return array
     *
     * @Route("/vocabulary/{vocabularyId}/folder/edit/{folderId}/", name="folder_edit")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @ParamConverter("folder", class="AppBundle:Folder")
     * @Template("AppBundle:VocabularyTree/Folder/Edit:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Vocabulary $vocabulary, Folder $folder)
    {
        $form = $this->createForm('folder', $folder, [
            'action' => $this->generateUrl(
                'folder_edit_post',
                [
                    'vocabularyId' => $vocabulary->getVocabularyId(),
                    'folderId'     => $folder->getFolderId()
                ]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     * @param Vocabulary $vocabulary
     * @param Folder $folder
     * @return mixed
     *
     * @Route("/vocabulary/{vocabularyId}/folder/edit/{folderId}/", name="folder_edit_post")
     * @ParamConverter("vocabulary", class="AppBundle:Vocabulary")
     * @ParamConverter("folder", class="AppBundle:Folder")
     * @Template("AppBundle:VocabularyTree/Folder/Edit:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Vocabulary $vocabulary, Folder $folder)
    {
        $form = $this->createForm('folder', $folder, [
            'action' => $this->generateUrl(
                'folder_edit_post',
                [
                    'vocabularyId' => $vocabulary->getVocabularyId(),
                    'folderId'     => $folder->getFolderId()
                ]
            )
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
