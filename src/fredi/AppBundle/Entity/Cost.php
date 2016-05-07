<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cost
 *
 * @ORM\Table(name="cost")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\CostRepository")
 */
class Cost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Reason")
     */
    private $reason;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Cost
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reason
     *
     * @param \fredi\AppBundle\Entity\Reason $reason
     *
     * @return Cost
     */
    public function setReason(\fredi\AppBundle\Entity\Reason $reason = null)
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Get reason
     *
     * @return \fredi\AppBundle\Entity\Reason
     */
    public function getReason()
    {
        return $this->reason;
    }
}
