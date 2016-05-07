<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use fredi\AppBundle\Entity\Cost as Cost;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CostLine
 *
 * @ORM\Table(name="cost_line")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\CostLineRepository")
 */
class CostLine
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
     * @var string
     *
     * @ORM\Column(name="cityStart", type="string", length=255, nullable=true)
     */
    private $cityStart;

    /**
     * @var string
     *
     * @ORM\Column(name="cityEnd", type="string", length=255, nullable=true)
     */
    private $cityEnd;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="float", nullable=true)
     */
    private $distance;

    /**
     * @var float
     *
     * @ORM\Column(name="journeyCost", type="float", nullable=true)
     */
    private $journeyCost;

    /**
     * @var float
     *
     * @ORM\Column(name="toll", type="float", nullable=true)
     */
    private $toll;

    /**
     * @var float
     *
     * @ORM\Column(name="meal", type="float", nullable=true)
     */
    private $meal;

    /**
     * @var float
     *
     * @ORM\Column(name="accommodation", type="float", nullable=true)
     */
    private $accommodation;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity="fredi\AppBundle\Entity\Cost",cascade={"persist"})
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Association")
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Member")
     */
    private $member;

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
     * Set cityStart
     *
     * @param string $cityStart
     *
     * @return CostLine
     */
    public function setCityStart($cityStart)
    {
        $this->cityStart = $cityStart;

        return $this;
    }

    /**
     * Get cityStart
     *
     * @return string
     */
    public function getCityStart()
    {
        return $this->cityStart;
    }

    /**
     * Set cityEnd
     *
     * @param string $cityEnd
     *
     * @return CostLine
     */
    public function setCityEnd($cityEnd)
    {
        $this->cityEnd = $cityEnd;

        return $this;
    }

    /**
     * Get cityEnd
     *
     * @return string
     */
    public function getCityEnd()
    {
        return $this->cityEnd;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return CostLine
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set journeyCost
     *
     * @param float $journeyCost
     *
     * @return CostLine
     */
    public function setJourneyCost($journeyCost)
    {
        $this->journeyCost = $journeyCost;

        return $this;
    }

    /**
     * Get journeyCost
     *
     * @return float
     */
    public function getJourneyCost()
    {
        return $this->journeyCost;
    }

    /**
     * Set toll
     *
     * @param float $toll
     *
     * @return CostLine
     */
    public function setToll($toll)
    {
        $this->toll = $toll;

        return $this;
    }

    /**
     * Get toll
     *
     * @return float
     */
    public function getToll()
    {
        return $this->toll;
    }

    /**
     * Set meal
     *
     * @param float $meal
     *
     * @return CostLine
     */
    public function setMeal($meal)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return float
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set accommodation
     *
     * @param float $accommodation
     *
     * @return CostLine
     */
    public function setAccommodation($accommodation)
    {
        $this->accommodation = $accommodation;

        return $this;
    }

    /**
     * Get accommodation
     *
     * @return float
     */
    public function getAccommodation()
    {
        return $this->accommodation;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return CostLine
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set cost
     *
     * @param \IKNSA\AppBundle\Entity\Cost $cost
     *
     * @return CostLine
     */
    public function setCost(\fredi\AppBundle\Entity\Cost $cost = null)
    {
        $this->cost = $cost;
        return $this;
    }
    /**
     * Get cost
     *
     * @return \fredi\AppBundle\Entity\Cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set association
     *
     * @param \fredi\AppBundle\Entity\Association $association
     *
     * @return CostLine
     */
    public function setAssociation(\fredi\AppBundle\Entity\Association $association = null)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * Get association
     *
     * @return \fredi\AppBundle\Entity\Association
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
