<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * Groups
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\GroupsRepository")
 */
class Groups extends BaseGroup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

