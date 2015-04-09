<?php
namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Language;

class LanguageFormType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'class'         => Language::class,
            'property'      => 'name',
            'query_builder' => function (EntityRepository $entityRepository) {
                return $entityRepository
                    ->createQueryBuilder('l')
                    ->orderBy('l.name', 'ASC');
            },
            'empty_value'   => 'Choose Language',
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