<?php
namespace AppBundle\Entity;

use CommonBundle\Entity\CreatedOnEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="languages")
 */
class Language
{
    use CreatedOnEntityTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="language_id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="code")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="origin")
     */
    private $origin;

    /** @return int */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /** @param int $languageId */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    /** @return string */
    public function getCode()
    {
        return $this->code;
    }

    /** @param string $code */
    public function setCode($code)
    {
        $this->code = $code;
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

    /** @return string */
    public function getOrigin()
    {
        return $this->origin;
    }

    /** @param string $origin */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }
}