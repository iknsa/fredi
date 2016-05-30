<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * UserReservation
 *
 * @ORM\Table(name="user_reservation")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\UserReservationRepository")
 */
class UserReservation
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
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\ReservationLine")
     */
    protected $reservationLine;

    /**
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\User")
     */
    protected $user;

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
     * Set reservationLine
     *
     * @param \fredi\AppBundle\Entity\ReservationLine $reservationLine
     *
     * @return UserReservation
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

    /**
     * Set user
     *
     * @param \fredi\AppBundle\Entity\User $user
     *
     * @return UserReservation
     */
    public function setUser(\fredi\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \fredi\AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
