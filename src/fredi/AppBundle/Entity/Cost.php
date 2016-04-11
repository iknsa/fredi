<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="journey", type="string", length=255, nullable=true)
     */
    private $journey;

    /**
     * @var int
     *
     * @ORM\Column(name="km", type="integer", nullable=true)
     */
    private $km;

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
     * @param string $reason
     *
     * @return Cost
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set journey
     *
     * @param string $journey
     *
     * @return Cost
     */
    public function setJourney($journey)
    {
        $this->journey = $journey;

        return $this;
    }

    /**
     * Get journey
     *
     * @return string
     */
    public function getJourney()
    {
        return $this->journey;
    }

    /**
     * Set km
     *
     * @param integer $km
     *
     * @return Cost
     */
    public function setKm($km)
    {
        $this->km = $km;

        return $this;
    }

    /**
     * Get km
     *
     * @return int
     */
    public function getKm()
    {
        return $this->km;
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

