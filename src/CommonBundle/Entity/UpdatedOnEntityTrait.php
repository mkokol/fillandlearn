<?php
namespace CommonBundle\Entity;

trait UpdatedOnEntityTrait
{
    /**
     * @ORM\Column(type="datetime", name="updated_on", nullable=false)
     */
    protected $updatedOn;

    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    }
}
