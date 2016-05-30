<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\Column(name="nbJours", type="string", length=255, nullable=true)
     */
    private $nbJours;

    /**
     * @var string
     *
     * @ORM\Column(name="nbPersonnes", type="string", length=255, nullable=true)
     */
    private $nbPersonnes;

    /**
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Association")
     */
    private $association;

    /**
     * @ORM\OneToOne(targetEntity="fredi\AppBundle\Entity\ReservationLine",cascade={"persist"})
     */
    private $reservationLine;


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
     * Set nbJours
     *
     * @param string $nbJours
     *
     * @return Reservation
     */
    public function setNbJours($nbJours)
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    /**
     * Get nbJours
     *
     * @return string
     */
    public function getNbJours()
    {
        return $this->nbJours;
    }

    /**
     * Set nbPersonnes
     *
     * @param string $nbPersonnes
     *
     * @return Reservation
     */
    public function setNbPersonnes($nbPersonnes)
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    /**
     * Get nbPersonnes
     *
     * @return string
     */
    public function getNbPersonnes()
    {
        return $this->nbPersonnes;
    }

    /**
     * Set association
     *
     * @param \fredi\AppBundle\Entity\Association $association
     *
     * @return Reservation
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

    /**
     * Set reservationLine
     *
     * @param \IKNSA\AppBundle\Entity\ReservationLine $reservationLine
     *
     * @return Reservation
     */
    public function setReservationLine(\fredi\AppBundle\Entity\ReservationLine $reservationLine = null)
    {
        $this->reservationLine = $reservationLine;
        return $this;
    }
    /**
     * Get reservationLine
     *
     * @return \fredi\AppBundle\Entity\ReservationLine
     */
    public function getReservationLine()
    {
        return $this->reservationLine;
    }
}

