<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FolderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', 'text', [
                'label'      => 'Folder Name',
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
            'data_class' => 'AppBundle\Entity\Folder',
            'attr'       => ['id' => 'folder-form']
        ]);
    }

    public function getName()
    {
        return 'folder';
    }
}