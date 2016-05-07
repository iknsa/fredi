<?php
namespace fredi\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use fredi\AppBundle\Entity\AssociationUser;

class LoadAssociationUser extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $associationUser1 = new AssociationUser;
        $associationUser1->setAssociation($this->getReference('association-1'));
        $associationUser1->setUser($this->getReference('member-member1'));
        $manager->persist($associationUser1);

        $associationUser2 = new AssociationUser;
        $associationUser2->setAssociation($this->getReference('association-2'));
        $associationUser2->setUser($this->getReference('member-member1'));
        $manager->persist($associationUser2);

        $associationUser3 = new AssociationUser;
        $associationUser3->setAssociation($this->getReference('association-3'));
        $associationUser3->setUser($this->getReference('member-member1'));
        $manager->persist($associationUser3);

        $associationUser4 = new AssociationUser;
        $associationUser4->setAssociation($this->getReference('association-4'));
        $associationUser4->setUser($this->getReference('member-member2'));
        $manager->persist($associationUser4);

        $associationUser5 = new AssociationUser;
        $associationUser5->setAssociation($this->getReference('association-5'));
        $associationUser5->setUser($this->getReference('member-member2'));
        $manager->persist($associationUser5);

        $associationUser6 = new AssociationUser;
        $associationUser6->setAssociation($this->getReference('association-6'));
        $associationUser6->setUser($this->getReference('member-member2'));
        $manager->persist($associationUser6);

        $manager->flush();

        $this->addReference('associationUser-1', $associationUser1);
        $this->addReference('associationUser-2', $associationUser2);
        $this->addReference('associationUser-3', $associationUser3);
        $this->addReference('associationUser-4', $associationUser4);
        $this->addReference('associationUser-5', $associationUser5);
        $this->addReference('associationUser-6', $associationUser6);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 400;
    }
}
