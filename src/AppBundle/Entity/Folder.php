<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use CommonBundle\Entity\UpdatedOnEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="folders")
 */
class Folder
{
    use CreatedOnEntityTrait;
    use UpdatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="folder_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $folderId;



    /**
     * @var Vocabulary
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vocabulary", inversedBy="folders")
     * @ORM\JoinColumn(name="vocabulary_id", referencedColumnName="vocabulary_id")
     **/
    private $vocabulary;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var Sheet[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sheet", mappedBy="folder")
     * @ORM\JoinColumn(name="folder_id", referencedColumnName="folder_id")
     **/
    private $sheets;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->updatedOn = new DateTime();
    }

    /** @return int */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /** @param int $folderId */
    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;
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

    /** @return bool */
    public function hasSheets(){
        return (bool) $this->sheets->count();
    }

    /** @return Sheet[] */
    public function getSheets()
    {
        return $this->sheets->toArray();
    }
}