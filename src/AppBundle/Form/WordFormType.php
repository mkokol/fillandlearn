<?php
namespace AppBundle\Form;

use AppBundle\Form\EventListener\AddUniqueWordEventListener;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WordFormType extends AbstractType
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $addUniqueWordEventListener = new AddUniqueWordEventListener(
            $this->em,
            $options['vocabulary'],
            $options['sheetWord']
        );

        $builder
            ->add('word', 'text', [
                'label'      => 'Word',
                'label_attr' => ['placeholder' => 'Word'],
                'attr'       => ['class' => 'form-control']
            ])
            ->add('translations', 'collection',
                array_merge(
                    [
                        'type'         => 'translation',
                        'allow_add'    => true,
                        'allow_delete' => true,
                        'prototype'    => true,
                        'by_reference' => false,
                    ],
                    (is_object($options['sheetWord'])) ? ['data' => $options['sheetWord']->getTranslations()] : []
                )
            )
            ->addEventSubscriber($addUniqueWordEventListener);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'           => 'AppBundle\Entity\Word',
            'attr'                 => ['id' => 'word-form'],
            'vocabulary'           => null,
            'sheetWord'            => null,
            'sheetWordTranslation' => []
        ]);
    }

    public function getName()
    {
        return 'word';
    }
}