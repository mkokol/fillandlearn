<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FillAndLearn\Learning\Statistic;

/**
 * @ORM\Entity
 * @ORM\Table(name="sheets_words")
 */
class SheetWord
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="sheet_word_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sheetWordId;

    /**
     * @var Sheet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sheet", inversedBy="sheetWord")
     * @ORM\JoinColumn(name="sheet_id", referencedColumnName="sheet_id")
     */
    private $sheet;

    /**
     * @var Word
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Word", inversedBy="sheetWord")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="word_id")
     */
    private $word;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SheetWordTranslation", mappedBy="sheetWord", cascade={"all"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="sheet_word_id", referencedColumnName="sheet_word_id")
     */
    private $sheetWordTranslations;

    /**
     * @var string
     *
     * @ORM\Column(name="statistic", type="string")
     */
    private $statistic;

    /**
     * @var int
     *
     * @ORM\Column(name="translation_statistic", type="integer")
     */
    private $translationStatistic;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->sheetWordTranslations = new ArrayCollection();

        $statistic = new Statistic();
        $this->statistic = $statistic->serialize();
        $this->translationStatistic = 0;
    }

    /** @return int */
    public function getSheetWordId()
    {
        return $this->sheetWordId;
    }

    /** @param int $sheetWordId */
    public function setSheetWordId($sheetWordId)
    {
        $this->sheetWordId = $sheetWordId;
    }

    /** @return Sheet */
    public function getSheet()
    {
        return $this->sheet;
    }

    /** @param Sheet $sheet */
    public function setSheet(Sheet $sheet)
    {
        $this->sheet = $sheet;
    }

    /** @return Word */
    public function getWord()
    {
        return $this->word;
    }

    /** @param Word $word */
    public function setWord(Word $word)
    {
        $this->word = $word;
    }

    public function getTranslations()
    {
        $translations = [];

        foreach ($this->sheetWordTranslations as $sheetWordTranslation) {
            $translations[] = $sheetWordTranslation->getTranslation();
        }

        return $translations;
    }

    /** @return SheetWord[] */
    public function getSheetWordTranslations()
    {
        return $this->sheetWordTranslations;
    }

    /** @param SheetWordTranslation $sheetWordTranslation */
    public function addSheetWordTranslation(SheetWordTranslation $sheetWordTranslation)
    {
        $sheetWordTranslation->setSheetWord($this);
        $this->sheetWordTranslations->add($sheetWordTranslation);
    }

    public function removeTranslationFromSheetWord(Translation $translation)
    {
        $sheetWordTranslationForRemove = null;

        /** @var SheetWordTranslation $sheetWordTranslation */
        foreach ($this->sheetWordTranslations->toArray() as $key => $sheetWordTranslation) {
            if ($sheetWordTranslation->getTranslation()->getTranslation() == $translation->getTranslation()) {
                $sheetWordTranslationForRemove = $sheetWordTranslation;
            }
        }

        if ($sheetWordTranslationForRemove) {
            $this->sheetWordTranslations->removeElement($sheetWordTranslationForRemove);
        }
    }

    /** @return Statistic */
    public function getStatistic()
    {
        return Statistic::deserialize($this->statistic);
    }

    /** @param Statistic $statistic */
    public function setStatistic(Statistic $statistic)
    {
        $this->statistic = $statistic->serialize();
    }

    /** @return int */
    public function getTranslationStatistic()
    {
        return $this->translationStatistic;
    }

    /** @param int $translationStatistic */
    public function setTranslationStatistic($translationStatistic)
    {
        $this->translationStatistic = $translationStatistic;
    }
}
