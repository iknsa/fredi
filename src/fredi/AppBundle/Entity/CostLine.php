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
     * @var int
     *
     * @ORM\Column(name="distance", type="integer", nullable=true)
     */
    private $distance;

    /**
     * @ORM\OneToOne(targetEntity="fredi\AppBundle\Entity\Cost",cascade={"persist"})
     */
    private $cost;

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
}
