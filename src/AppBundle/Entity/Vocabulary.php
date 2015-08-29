<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VocabularyRepository")
 * @ORM\Table(name="vocabularies")
 */
class Vocabulary
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="vocabulary_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $vocabularyId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="primary_language_id", referencedColumnName="language_id")
     */
    private $primaryLanguage;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Language")
     * @ORM\JoinColumn(name="secondary_language_id", referencedColumnName="language_id")
     */
    private $secondaryLanguage;

    /**
     * @var Folder[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Folder", mappedBy="vocabulary")
     **/
    private $folders;

    /**
     * @var Sheet[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sheet", mappedBy="vocabulary", cascade={"all"})
     * @ORM\JoinColumn(name="vocabulary_id", referencedColumnName="vocabulary_id")
     **/
    private $sheets;

    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->folders = new ArrayCollection();
        $this->sheets = new ArrayCollection();
    }

    /** @return int */
    public function getVocabularyId()
    {
        return $this->vocabularyId;
    }

    /** @param int $vocabularyId */
    public function setVocabularyId($vocabularyId)
    {
        $this->vocabularyId = $vocabularyId;
    }

    /** @return mixed */
    public function getUser()
    {
        return $this->user;
    }

    /** @param User $user */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /** @return Language */
    public function getPrimaryLanguage()
    {
        return $this->primaryLanguage;
    }

    /** @param Language $language */
    public function setPrimaryLanguage(Language $language)
    {
        $this->primaryLanguage = $language;
    }

    /** @return int */
    public function getPrimaryLanguageId()
    {
        return $this->primaryLanguage->getLanguageId();
    }

    /** @return Language */
    public function getSecondaryLanguage()
    {
        return $this->secondaryLanguage;
    }

    /** @param Language $language */
    public function setSecondaryLanguage(Language $language)
    {
        $this->secondaryLanguage = $language;
    }

    /** @return int */
    public function getSecondaryLanguageId()
    {
        return $this->secondaryLanguage->getLanguageId();
    }

    /** @return bool */
    public function hasFolders()
    {
        return (bool)$this->folders->count();
    }

    /** @return Folder[] */
    public function getFolders()
    {
        return $this->folders->toArray();
    }

    /** @return bool */
    public function hasSheets()
    {
        return (bool)$this->sheets->count();
    }

    /** @return Sheet[] */
    public function getSheets()
    {
        return $this->sheets->toArray();
    }
}