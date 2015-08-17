<?php
namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'User Name',
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'First Name, Last Name'
                ]
            ])
            ->add('email', 'email', [
                'label' => 'Email',
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'Email Address'
                ]
            ])
            ->add('password', 'repeated', [
                'first_name'     => 'password',
                'second_name'    => 'repeat',
                'type'           => 'password',
                'first_options'  => [
                    'label' => 'Password'
                ],
                'second_options' => [
                    'label' => 'Repeat Password'
                ],
                'options'        => [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UserBundle\Entity\User',
        ]);
    }

    public function getName()
    {
        return 'user_registration';
    }
}