<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="translations")
 */
class Translation
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="translation_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $translationId;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     **/
    private $language;

    /**
     * @var Word
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Word", inversedBy="translations", cascade={"all"})
     * @ORM\JoinColumn(name="word_id", referencedColumnName="word_id")
     **/
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="translation")
     */
    private $translation;

    public function __construct()
    {
        $this->createdOn = new DateTime();
    }

    /** @return int */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /** @param int $translationId */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
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

    /** @param Word $word */
    public function setWord(Word $word){
        $this->word = $word;
    }

    /** @return Word */
    public function getWord()
    {
        return $this->word;
    }

    /** @return string */
    public function getTranslation()
    {
        return $this->translation;
    }

    /** @param string $translation */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
    }
}