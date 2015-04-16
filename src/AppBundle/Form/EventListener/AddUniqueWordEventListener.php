<?php
namespace AppBundle\Form\EventListener;

use AppBundle\Entity\SheetWord;
use AppBundle\Entity\SheetWordTranslation;
use AppBundle\Entity\Translation;
use AppBundle\Entity\Vocabulary;
use AppBundle\Entity\Word;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddUniqueWordEventListener implements EventSubscriberInterface
{
    /** @var EntityManager $em */
    private $em;

    /** @var Vocabulary $vocabulary */
    private $vocabulary;

    /** @var SheetWord $sheetWord */
    private $sheetWord;

    public function __construct(EntityManager $em, Vocabulary $vocabulary = null, SheetWord $sheetWord = null)
    {
        $this->em = $em;
        $this->vocabulary = $vocabulary;
        $this->sheetWord = $sheetWord;
    }

    public static function getSubscribedEvents()
    {
        return [FormEvents::SUBMIT => 'preSubmit'];
    }

    public function preSubmit(FormEvent $event)
    {
        /** @var Word $newWord */
        $newWord = $event->getData();
        $existedWord = $this->em
            ->getRepository('AppBundle:Word')
            ->findOneBy(['word' => $newWord->getWord()]);

        if ($existedWord) {
            $this->mergerTranslation($existedWord, $newWord);
            $event->setData($existedWord);
            $this->sheetWord->setWord($existedWord);
        } else {
            $newWord->setLanguage($this->vocabulary->getPrimaryLanguage());
            $this->sheetWord->setWord($newWord);

            /** @var Translation $translation */
            foreach ($newWord->getTranslations()->toArray() as $translation) {
                $translation->setLanguage($this->vocabulary->getSecondaryLanguage());
                $this->addTranslationToSheetWord($translation);
            }

            $event->setData($newWord);
        }
    }

    private function mergerTranslation(Word $existedWord, Word $newWord)
    {
        /** @var Translation $translation */
        foreach ($newWord->getTranslations()->toArray() as $newTranslation) {
            $this->addIfWordDosNotContainTranslation($existedWord, $newTranslation);
        }
    }

    private function addIfWordDosNotContainTranslation(Word $existedWord, Translation $newTranslation)
    {
        /** @var Translation $existedTranslation */
        foreach ($existedWord->getTranslations()->toArray() as $existedTranslation) {
            if ($existedTranslation->getTranslation() == $newTranslation->getTranslation()
                && $existedTranslation->getLanguageId() == $this->vocabulary->getSecondaryLanguageId()
            ) {
                $this->addTranslationToSheetWord($existedTranslation);

                return;
            }
        }

        $this->addTranslationToSheetWord($newTranslation);
        $newTranslation->setLanguage($this->vocabulary->getSecondaryLanguage());
        $existedWord->addTranslation($newTranslation);
    }

    private function addTranslationToSheetWord($translation)
    {
        $sheetWordTranslation = new SheetWordTranslation();
        $sheetWordTranslation->setTranslation($translation);
        $this->sheetWord->addSheetWordTranslation($sheetWordTranslation);
    }
}