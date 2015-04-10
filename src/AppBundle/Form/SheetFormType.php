<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SheetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', 'text', [
                'label'      => 'Shee Name',
                'label_attr' => [
                    'placeholder' => 'Title'
                ],
                'attr'       => [
                    'class' => 'form-control',
                ]
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Sheet',
            'attr'       => ['id' => 'sheet-form']
        ]);
    }

    public function getName()
    {
        return 'sheet';
    }
}