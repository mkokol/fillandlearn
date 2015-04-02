<?php
namespace Bundles\UserBundle\Entity;

use Bundles\GeneralBundle\Entity\CreatedOnEntityTrait;
use Bundles\GeneralBundle\Entity\UpdatedOnEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users
{
    use CreatedOnEntityTrait;
    use UpdatedOnEntityTrait;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", name="user_id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_name")
     * @Assert\NotBlank()
     */
    private $userName;

    /**
     * @var string
     * @ORM\Column(type="string", name="email")
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", name="password")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", name="salt")
     */
    private $salt;

    /**
     * @ORM\ManyToMany(targetEntity="Roles")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")}
     * )
     * @var ArrayCollection $userRoles
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->salt = hash('sha256', uniqid(rand(), true));
        $this->createdOn = new DateTime();
        $this->updatedOn = new DateTime();
    }

    /** @return integer */
    public function getId()
    {
        return $this->id;
    }

    /** @param string $userName */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /** @return string */
    public function getUserName()
    {
        return $this->userName;
    }

    /** @param string $email */
    public function setEmail($email)
    {
        $this->email = strtolower($email);
    }

    /** @return string */
    public function getEmail()
    {
        return $this->email;
    }

    /** @param string $password */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /** @return string */
    public function getPassword()
    {
        return $this->password;
    }

    /** @param string $salt */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /** @return string */
    public function getSalt()
    {
        return $this->salt;
    }

    /** @param Roles $role */
    public function addRole(Roles $role)
    {
        $this->roles[] = $role;
    }

    /** @return Roles[] */
    public function getRoles()
    {
        return $this->roles->toArray();
    }
}
