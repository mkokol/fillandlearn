<?php
namespace UserBundle\Controller;

use UserBundle\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("", name="user_registration")
     * @Template("UserBundle:Registration:get.html.twig")
     * @Method({"GET"})
     */
    public function getAction()
    {
        $form = $this->createForm('user_registration', new Users());

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("", name="user_registration_post")
     * @Template("UserBundle:Registration:get.html.twig")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm('user_registration', $user);
        $form->handleRequest($request);
        $this->encodeUserPassword($user);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $roles = $em->getRepository('UserBundle:Roles')->findOneBy(['name' => 'ROLE_USER']);
            $user->addRole($roles);
            $em->persist($user);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('home')
            );
        }

        return [
            'form' => $form->createView()
        ];
    }

    private function encodeUserPassword($user)
    {
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $passwordEncoded = $encoder->encodePassword($user->getPassword(), $user->getSalt());
        $user->setPassword($passwordEncoded);
    }
}