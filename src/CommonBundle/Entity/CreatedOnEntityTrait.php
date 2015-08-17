<?php
namespace CommonBundle\Entity;

trait CreatedOnEntityTrait
{
    /**
     * @ORM\Column(type="datetime", name="created_on", nullable=false)
     */
    protected $createdOn;

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }
}
