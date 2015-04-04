<?php
namespace Bundles\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Roles
{
    /**
     * @ORM\Column(name="role_id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $roleId;

    /**
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /** @return integer */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /** @return string */
    public function getName()
    {
        return $this->name;
    }
}