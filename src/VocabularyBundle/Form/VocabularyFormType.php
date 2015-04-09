<?php
namespace VocabularyBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VocabularyBundle\Entity\Language;

class VocabularyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', 'text', [
                'label'      => 'Title',
                'label_attr' => [
                    'placeholder' => 'Title'
                ],
                'attr'       => [
                    'class' => 'form-control',
                ]
            ])
            ->add('primaryLanguage', 'choice_language')
            ->add('secondaryLanguage', 'choice_language');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'VocabularyBundle\Entity\Vocabulary',
        ]);
    }

    public function getName()
    {
        return 'vocabulary';
    }
}