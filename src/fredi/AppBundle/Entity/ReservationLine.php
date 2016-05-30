<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * ReservationLine
 *
 * @ORM\Table(name="reservation_line")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\ReservationLineRepository")
 */
class ReservationLine
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
     * @return ReservationLine
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
}

