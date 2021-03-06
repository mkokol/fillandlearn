<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VocabularyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('primaryLanguage', 'choice_language')
            ->add('secondaryLanguage', 'choice_language');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Vocabulary',
            'attr'       => ['id' => 'vocabulary-form']
        ]);
    }

    public function getName()
    {
        return 'vocabulary';
    }
}