<?php
namespace VocabularyBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VocabularyBundle\Entity\Language;

class LanguageFormType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => Language::class,
            'class'         => Language::class,
            'property'      => 'name',
            'query_builder' => function (EntityRepository $entityRepository) {
                return $entityRepository
                    ->createQueryBuilder('l')
                    ->orderBy('l.name', 'ASC');
            },
            'empty_value'   => 'Choose Category',
        ]);
    }

    public function getName()
    {
        return 'choice_language';
    }

    public function getParent()
    {
        return 'entity';
    }
}