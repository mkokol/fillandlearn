<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use CommonBundle\Entity\UpdatedOnEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sheets")
 */
class Sheet
{
    use CreatedOnEntityTrait;
    use UpdatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="sheet_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sheetId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var Vocabulary
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vocabulary", inversedBy="sheets", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="vocabulary_id", referencedColumnName="vocabulary_id")
     **/
    private $vocabulary;

    /**
     * @var Folder
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Folder", inversedBy="sheets")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="folder_id")
     **/
    private $folder;

    /**
     * @var SheetWord[] $words
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SheetWord", mappedBy="sheet")
     * @ORM\JoinColumn(name="sheet_id", referencedColumnName="sheet_id")
     */
    private $sheetWord;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->updatedOn = new DateTime();
        $this->sheetWord = new ArrayCollection();
    }

    /** @return int */
    public function getSheetId()
    {
        return $this->sheetId;
    }

    /** @param int $sheetId */
    public function setSheetId($sheetId)
    {
        $this->sheetId = $sheetId;
    }

    /** @return string */
    public function getName()
    {
        return $this->name;
    }

    /** @param string $name */
    public function setName($name)
    {
        $this->name = $name;
    }

    /** @param Vocabulary $vocabulary */
    public function setVocabulary(Vocabulary $vocabulary)
    {
        $this->vocabulary = $vocabulary;
    }

    /** @return Vocabulary */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }

    /** @return int */
    public function getVocabularyId()
    {
        return $this->vocabulary->getVocabularyId();
    }

    /** @param Folder $folder */
    public function setFolder(Folder $folder)
    {
        $this->folder = $folder;
    }

    /** @return Folder */
    public function getFolder()
    {
        return $this->folder;
    }

    /** @return SheetWord[] */
    public function getSheetWord()
    {
        return $this->sheetWord;
    }

    /** @param SheetWord $sheetWord */
    public function addSheetWord(SheetWord $sheetWord)
    {
        $this->sheetWord[] = $sheetWord;
    }

    /** @return int */
    public function getSheetWordCount()
    {
        return $this->sheetWord->count();
    }
}