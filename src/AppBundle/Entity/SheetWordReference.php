<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sheets_words")
 */
class SheetWordReference
{
    use CreatedOnEntityTrait;

    /**
     * @var Sheet
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sheet", inversedBy="sheetWordReferences", cascade={"all"})
     * @ORM\JoinColumn(name="sheet_id", referencedColumnName="sheet_id")
     */
    private $sheet;

    /**
     * @var Word
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Word", inversedBy="sheetWordReferences", cascade={"all"})
     * @ORM\JoinColumn(name="word_id", referencedColumnName="word_id")
     */
    private $word;

    public function __construct()
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getSheet()
    {
        return $this->sheet;
    }

    /** @param Sheet $sheet */
    public function setSheet(Sheet $sheet)
    {
        $this->sheet = $sheet;
    }

    /** @return int */
    public function getWord()
    {
        return $this->word;
    }

    /** @param Word $word */
    public function setWord(Word $word)
    {
        $this->word = $word;
    }
}