<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sheets_words_translations")
 */
class SheetWordTranslation
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="sheet_word_translation_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sheetWordTranslationId;

    /**
     * @var SheetWord
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SheetWord", inversedBy="sheetWordTranslations", cascade={"all"})
     * @ORM\JoinColumn(name="sheet_word_id", referencedColumnName="sheet_word_id")
     */
    private $sheetWord;

    /**
     * @var Translation
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Translation")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="translation_id")
     */
    private $translation;


    public function __construct()
    {
        $this->createdOn = new DateTime();
    }

    /** @return int */
    public function getSheetWordTranslationId()
    {
        return $this->sheetWordTranslationId;
    }

    /** @param int $sheetWordTranslationId */
    public function setSheetWordTranslationId($sheetWordTranslationId)
    {
        $this->sheetWordTranslationId = $sheetWordTranslationId;
    }

    /** @return SheetWord */
    public function getSheetWord()
    {
        return $this->sheetWord;
    }

    /** @param SheetWord $sheetWord */
    public function setSheetWord(SheetWord $sheetWord)
    {
        $this->sheetWord = $sheetWord;
    }

    /** @return Translation */
    public function getTranslation()
    {
        return $this->translation;
    }

    /** @param Translation $translation */
    public function setTranslation(Translation $translation)
    {
        $this->translation = $translation;
    }


}