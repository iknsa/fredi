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
        $associationUser1->setUser($this->getReference('admin-admin'));
        $manager->persist($associationUser1);

        $associationUser2 = new AssociationUser;
        $associationUser2->setAssociation($this->getReference('association-2'));
        $associationUser2->setUser($this->getReference('admin-admin'));
        $manager->persist($associationUser2);

        $associationUser3 = new AssociationUser;
        $associationUser3->setAssociation($this->getReference('association-3'));
        $associationUser3->setUser($this->getReference('admin-admin'));
        $manager->persist($associationUser3);

        $manager->flush();

        $this->addReference('associationUser-1', $associationUser1);
        $this->addReference('associationUser-2', $associationUser2);
        $this->addReference('associationUser-3', $associationUser3);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 400;
    }
}
