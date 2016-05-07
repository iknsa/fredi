<?php

namespace fredi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Association
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="fredi\AppBundle\Repository\AssociationRepository")
 */
class Association
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
    * @var string
    * @ORM\Column(name="unique_id", type="string", length=255, nullable=true)
    */
    private $uniqueId;

    /**
     * @ORM\OneToMany(targetEntity="AssociationUser", mappedBy="association")
     */
    protected $associationUsers;
    
    /**
     * @ORM\ManyToMany(targetEntity="Member", inversedBy="associations")
     * @ORM\JoinTable(name="association_member",
     *      joinColumns={@ORM\JoinColumn(name="association_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")}
     *      )
     **/
    protected $members;

    public function __construct()
    {
        $this->setuniqueId(uniqid());
        $this->members = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Association
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Association
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Association
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Association
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set uniqueId
     *
     * @param string $uniqueId
     *
     * @return Association
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }
    /**
     * Get uniqueId
     *
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Set associationUser
     *
     * @param \fredi\AppBundle\Entity\AssociationUser $associationUsers
     *
     * @return Association
     */
    public function setAssociationUser(\fredi\AppBundle\Entity\AssociationUser $associationUsers = null)
    {
        $this->associationUsers = $associationUsers;
        return $this;
    }

    /**
     * Get associationUser
     *
     * @return \fredi\AppBundle\Entity\AssociationUser
     */
    public function getAssociationUser()
    {
        return $this->associationUsers;
    }

    /**
     * Set member
     *
     * @param \fredi\AppBundle\Entity\Member $member
     *
     * @return Association
     */
    public function setMember(\fredi\AppBundle\Entity\Member $member = null)
    {
        $this->member = $member;
        return $this;
    }

    /**
     * Get member
     *
     * @return \fredi\AppBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Add members
     *
     * @param \fredi\AppBundle\Entity\Member $members
     * @return Association
     */
    public function addMember(\fredi\AppBundle\Entity\Member $members)
    {
        $this->members[] = $members;
        $members->addAssociation($this);

        return $this;
    }

    public function removeMember(\fredi\AppBundle\Entity\Member $member)
    {
        $this->members->removeElement($member);
    }


    public function getMembers()
    {
        return $this->members;
    }
}
