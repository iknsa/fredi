<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CostUser
 *
 * @ORM\Table(name="cost_user")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\CostUserRepository")
 */
class CostUser
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
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Cost")
     */
    protected $cost;

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
     * Set cost
     *
     * @param \fredi\AppBundle\Entity\Cost $cost
     *
     * @return CostUser
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
     * Set user
     *
     * @param \fredi\AppBundle\Entity\User $user
     *
     * @return CostUser
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
