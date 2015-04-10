<?php

namespace AppBundle\Controller\VocabularyTree\Sheet;

use AppBundle\Entity\Folder;
use AppBundle\Entity\Sheet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddToFolderController extends Controller
{

    /**
     * @param Folder $folder
     * @return mixed
     *
     * @Route("/sheet/add/folder/{folderId}/", name="folder_sheet_add")
     * @ParamConverter("folder", class="AppBundle:Folder")
     * @Template("AppBundle:VocabularyTree/Sheet/AddTo:get.html.twig")
     * @Method({"GET"})
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction(Folder $folder)
    {
        $sheet = new Sheet();
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'folder_sheet_add_post',
                ['folderId' => $folder->getFolderId()]
            )
        ]);

        return ['form' => $form->createView()];
    }

    /**
     * @param Request $request
     * @param Folder $folder
     * @return mixed
     *
     * @Route("/sheet/add/folder/{folderId}/", name="folder_sheet_add_post")
     * @ParamConverter("folder", class="AppBundle:Folder")
     * @Template("AppBundle:VocabularyTree/Sheet/AddTo:get.html.twig")
     * @Method({"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request, Folder $folder)
    {
        $sheet = new Sheet();
        $sheet->setFolder($folder);
        $form = $this->createForm('sheet', $sheet, [
            'action' => $this->generateUrl(
                'folder_sheet_add_post',
                ['folderId' => $folder->getFolderId()]
            )
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($sheet);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        return ['form' => $form->createView()];
    }
}