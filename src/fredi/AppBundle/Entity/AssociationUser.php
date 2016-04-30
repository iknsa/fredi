<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * associationUser
 *
 * @ORM\Table(name="association_user")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\AssociationUserRepository")
 */
class AssociationUser
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
     * @ORM\ManyToOne(targetEntity="fredi\AppBundle\Entity\Association")
     */
    protected $association;

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
     * Set association
     *
     * @param \fredi\AppBundle\Entity\Association $association
     *
     * @return AssociationUser
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
     * Set user
     *
     * @param \fredi\AppBundle\Entity\User $user
     *
     * @return AssociationUser
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
