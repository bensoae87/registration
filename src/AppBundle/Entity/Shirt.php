<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shirt
 *
 * @ORM\Table(name="shirt", indexes={@ORM\Index(name="FK1_Shirt_CreatedBy", columns={"CreatedBy"}), @ORM\Index(name="FK2_Shirt_ModifiedBy", columns={"ModifiedBy"})})
 * @ORM\Entity
 */
class Shirt
{
    /**
     * @var string
     *
     * @ORM\Column(name="ShirtSize", type="string", length=255, nullable=false)
     */
    private $shirtsize;

    /**
     * @var string
     *
     * @ORM\Column(name="ShirtType", type="string", length=255, nullable=false)
     */
    private $shirttype;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedDate", type="datetime", nullable=true)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ModifiedDate", type="datetime", nullable=true)
     */
    private $modifieddate;

    /**
     * @var integer
     *
     * @ORM\Column(name="Shirt_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shirtId;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CreatedBy", referencedColumnName="User_ID")
     * })
     */
    private $createdby;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ModifiedBy", referencedColumnName="User_ID")
     * })
     */
    private $modifiedby;



    /**
     * Set shirtsize
     *
     * @param string $shirtsize
     *
     * @return Shirt
     */
    public function setShirtsize($shirtsize)
    {
        $this->shirtsize = $shirtsize;

        return $this;
    }

    /**
     * Get shirtsize
     *
     * @return string
     */
    public function getShirtsize()
    {
        return $this->shirtsize;
    }

    /**
     * Set shirttype
     *
     * @param string $shirttype
     *
     * @return Shirt
     */
    public function setShirttype($shirttype)
    {
        $this->shirttype = $shirttype;

        return $this;
    }

    /**
     * Get shirttype
     *
     * @return string
     */
    public function getShirttype()
    {
        return $this->shirttype;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Shirt
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createddate
     *
     * @param \DateTime $createddate
     *
     * @return Shirt
     */
    public function setCreateddate($createddate)
    {
        $this->createddate = $createddate;

        return $this;
    }

    /**
     * Get createddate
     *
     * @return \DateTime
     */
    public function getCreateddate()
    {
        return $this->createddate;
    }

    /**
     * Set modifieddate
     *
     * @param \DateTime $modifieddate
     *
     * @return Shirt
     */
    public function setModifieddate($modifieddate)
    {
        $this->modifieddate = $modifieddate;

        return $this;
    }

    /**
     * Get modifieddate
     *
     * @return \DateTime
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * Get shirtId
     *
     * @return integer
     */
    public function getShirtId()
    {
        return $this->shirtId;
    }

    /**
     * Set createdby
     *
     * @param \AppBundle\Entity\User $createdby
     *
     * @return Shirt
     */
    public function setCreatedby(\AppBundle\Entity\User $createdby = null)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set modifiedby
     *
     * @param \AppBundle\Entity\User $modifiedby
     *
     * @return Shirt
     */
    public function setModifiedby(\AppBundle\Entity\User $modifiedby = null)
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }

    /**
     * Get modifiedby
     *
     * @return \AppBundle\Entity\User
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }
}