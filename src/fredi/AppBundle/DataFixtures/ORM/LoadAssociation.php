<?php

namespace fredi\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use fredi\AppBundle\Entity\Association;
use fredi\AppBundle\Entity\Member;

class LoadAssociation extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->getContainer = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $doctrineManager = $this->getContainer->get('doctrine');

        $em = $doctrineManager->getManager();

        $member1 = new Member;
        $member1->setName('Lievin');
        $member1->setSurname('Nathan');
        $member1->setSexe('M');
        $member1->setBirthDate(new \DATETIME('1997/01/24'));
        $member1->setAddress('42, rue de la commanderie');
        $member1->setPostalCode('54840');
        $member1->setCity('Sexey les Bois');
        $member1->setLicenseNumber('170540010401');
        $manager->persist($member1);

        $member2 = new Member;
        $member2->setName('Silbert');
        $member2->setSurname('Lea');
        $member2->setSexe('F');
        $member2->setBirthDate(new \DATETIME('2000/04/14'));
        $member2->setAddress('1, allée du cénacle');
        $member2->setPostalCode('54520');
        $member2->setCity('Laxou');
        $member2->setLicenseNumber('170540010447');
        $manager->persist($member2);

        $member3 = new Member;
        $member3->setName('Silbert');
        $member3->setSurname('Gilles');
        $member3->setSexe('M');
        $member3->setBirthDate(new \DATETIME('1957/01/03'));
        $member3->setAddress('1, allée du cénacle');
        $member3->setPostalCode('54520');
        $member3->setCity('Laxou');
        $member3->setLicenseNumber('170540010121');
        $manager->persist($member3);

        $member4 = new Member;
        $member4->setName('Bilot');
        $member4->setSurname('Marrianne');
        $member4->setSexe('F');
        $member4->setBirthDate(new \DATETIME('1986/09/28'));
        $member4->setAddress('6, rue de la Sapinière');
        $member4->setPostalCode('54600');
        $member4->setCity('Villers les Nancy');
        $member4->setLicenseNumber('170540010254');
        $manager->persist($member4);

        $association1 = new Association;
        $association1->setName('ASNL Nancy');
        $association1->setCity('Velaine-en-Haye');
        $association1->setAddress('Parc de Haye');
        $association1->setPostalCode('54840');
        $association1
            ->addMember($member1)
            ->addMember($member4)
        ;
        $manager->persist($association1);

        $association2 = new Association;
        $association2->setName('ASPTT Metz');
        $association2->setCity('Metz');
        $association2->setAddress('1 rue Lormont');
        $association2->setPostalCode('88000');
        $association2
            ->addMember($member4)
        ;
        $manager->persist($association2);

        $association3 = new Association;
        $association3->setName('GAMYO Epinal');
        $association3->setCity('Epinal');
        $association3->setAddress('1 rue des hauts Peupliers');
        $association3->setPostalCode('57070');
        $association3
            ->addMember($member2)
            ->addMember($member3)
        ;
        $manager->persist($association3);

        $manager->flush();

        $this->addReference('association-1', $association1);
        $this->addReference('association-2', $association2);
        $this->addReference('association-3', $association3);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 300;
    }
}
