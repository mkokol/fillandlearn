<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use CommonBundle\Entity\UpdatedOnEntityTrait;
use DateTime;
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
     * @ORM\Column(name="sheet_id", type="integer")
     * @ORM\Id()
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
     * @0RM\Column(name="vocabulary_id", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vocabulary", inversedBy="sheets")
     * @ORM\JoinColumn(name="vocabulary_id", referencedColumnName="vocabulary_id")
     **/
    private $vocabulary;

    /**
     * @var Folder
     *
     * @0RM\Column(name="folder_id", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Folder", inversedBy="sheets")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="folder_id")
     **/
    private $folder;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->updatedOn = new DateTime();
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
}