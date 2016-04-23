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
 * @Gedmo\SoftDeleteable(fieldName="deleted_at", timeAware=false)
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
     * @var int
     *
     * @ORM\Column(name="journeyCost", type="integer", nullable=true)
     */
    private $journeyCost;

    /**
     * @var int
     *
     * @ORM\Column(name="toll", type="integer", nullable=true)
     */
    private $toll;

    /**
     * @var int
     *
     * @ORM\Column(name="meal", type="integer", nullable=true)
     */
    private $meal;

    /**
     * @var int
     *
     * @ORM\Column(name="accommodation", type="integer", nullable=true)
     */
    private $accommodation;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total;


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

    /**
     * Set journeyCost
     *
     * @param integer $journeyCost
     *
     * @return Cost
     */
    public function setJourneyCost($journeyCost)
    {
        $this->journeyCost = $journeyCost;

        return $this;
    }

    /**
     * Get journeyCost
     *
     * @return int
     */
    public function getJourneyCost()
    {
        return $this->journeyCost;
    }

    /**
     * Set toll
     *
     * @param integer $toll
     *
     * @return Cost
     */
    public function setToll($toll)
    {
        $this->toll = $toll;

        return $this;
    }

    /**
     * Get toll
     *
     * @return int
     */
    public function getToll()
    {
        return $this->toll;
    }

    /**
     * Set meal
     *
     * @param integer $meal
     *
     * @return Cost
     */
    public function setMeal($meal)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return int
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set accommodation
     *
     * @param integer $accommodation
     *
     * @return Cost
     */
    public function setAccommodation($accommodation)
    {
        $this->accommodation = $accommodation;

        return $this;
    }

    /**
     * Get accommodation
     *
     * @return int
     */
    public function getAccommodation()
    {
        return $this->accommodation;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Cost
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
