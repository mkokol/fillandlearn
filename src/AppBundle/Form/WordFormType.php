<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('word', 'text', [
                'label'      => 'Word',
                'label_attr' => ['placeholder' => 'Word'],
                'attr'       => ['class' => 'form-control']
            ])
            ->add('translations', 'collection', [
                'type'         => 'translation',
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Word',
            'attr'       => ['id' => 'word-form']
        ]);
    }

    public function getName()
    {
        return 'word';
    }
}