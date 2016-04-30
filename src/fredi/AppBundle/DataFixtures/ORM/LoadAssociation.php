<?php

namespace fredi\AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use fredi\AppBundle\Entity\Association;

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

        $association1 = new Association;
        $association1->setName('ASNL Nancy');
        $association1->setCity('Velaine-en-Haye');
        $association1->setAddress('Parc de Haye');
        $association1->setPostalCode('54840');
        $manager->persist($association1);

        $association2 = new Association;
        $association2->setName('ASPTT Metz');
        $association2->setCity('Metz');
        $association2->setAddress('1 rue Lormont');
        $association2->setPostalCode('88000');
        $manager->persist($association2);

        $association3 = new Association;
        $association3->setName('GAMYO Epinal');
        $association3->setCity('Epinal');
        $association3->setAddress('1 rue des hauts Peupliers');
        $association3->setPostalCode('57070');
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
