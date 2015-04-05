<?php
namespace Bundles\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_name', 'text')
            ->add('email', 'email')
            ->add('password', 'repeated', [
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password'
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Bundles\UserBundle\Entity\Users',
        ]);
    }

    public function getName()
    {
        return 'user_registration';
    }
}