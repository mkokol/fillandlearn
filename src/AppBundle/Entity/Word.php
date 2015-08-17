<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="words")
 * @UniqueEntity("word")
 */
class Word
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="word_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $wordId;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     **/
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="word", unique=true)
     */
    private $word;

    /**
     * @var ArrayCollection Translation
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Translation", mappedBy="word", cascade={"all"})
     * @ORM\JoinColumn(name="word_id", referencedColumnName="word_id")
     */
    private $translations;

    /**
     * @var ArrayCollection $words
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SheetWord", mappedBy="word")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="word_id")
     */
    private $sheetWord;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->translations = new ArrayCollection();
        $this->sheetWord = new ArrayCollection();
    }

    /** @return int */
    public function getWordId()
    {
        return $this->wordId;
    }

    /** @param int $wordId */
    public function setWordId($wordId)
    {
        $this->wordId = $wordId;
    }

    /** @param Language $language */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }

    /** @return Language */
    public function getLanguage()
    {
        return $this->language;
    }

    /** @return string */
    public function getWord()
    {
        return $this->word;
    }

    /** @param string $word */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /** @return bool */
    public function hasTranslations()
    {
        return (bool)$this->translations->count();
    }

    /** @return ArrayCollection */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param Translation $translation
     * @return Word
     */
    public function addTranslation(Translation $translation)
    {
        $translation->setWord($this);
        $this->translations[] = $translation;

        return $this;
    }

    /** @param Translation $translation */
    public function removeTranslation(Translation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /** @return ArrayCollection */
    public function getSheetWord()
    {
        return $this->sheetWord;
    }

    /** @param SheetWord $sheetWord */
    public function addSheetWord(SheetWord $sheetWord)
    {
        $this->sheetWord[] = $sheetWord;
    }

    public function __toString()
    {
        return strval($this->wordId);
    }
}