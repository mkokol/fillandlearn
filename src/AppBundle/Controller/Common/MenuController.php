<?php
namespace AppBundle\Controller\Common;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    /**
     * @Template("AppBundle:Common/Menu:get.html.twig")
     */
    public function getAction()
    {
        $authChecker = $this->get('security.authorization_checker');
        if (!$authChecker->isGranted('ROLE_USER')) {
            return [];
        }

        $em = $this->getDoctrine()->getManager();
        $vocabularies = $em->getRepository('AppBundle:Vocabulary')
            ->findByUser($this->getUser());

        return ['vocabularies' => $vocabularies];
    }
}
