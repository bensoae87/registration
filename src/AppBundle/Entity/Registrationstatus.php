<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registrationstatus
 *
 * @ORM\Table(name="registrationstatus", indexes={@ORM\Index(name="FK1_RegistrationStatus_CreatedBy", columns={"CreatedBy"}), @ORM\Index(name="FK2_RegistrationStatus_ModifiedBy", columns={"ModifiedBy"})})
 * @ORM\Entity
 */
class Registrationstatus
{
    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Active", type="string", length=255, nullable=false)
     */
    private $active = 'false';

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
     * @ORM\Column(name="RegistrationStatus_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $registrationstatusId;

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
     * Set status
     *
     * @param string $status
     *
     * @return Registrationstatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Registrationstatus
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
     * Set active
     *
     * @param string $active
     *
     * @return Registrationstatus
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createddate
     *
     * @param \DateTime $createddate
     *
     * @return Registrationstatus
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
     * @return Registrationstatus
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
     * Get registrationstatusId
     *
     * @return integer
     */
    public function getRegistrationstatusId()
    {
        return $this->registrationstatusId;
    }

    /**
     * Set createdby
     *
     * @param \AppBundle\Entity\User $createdby
     *
     * @return Registrationstatus
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
     * @return Registrationstatus
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
