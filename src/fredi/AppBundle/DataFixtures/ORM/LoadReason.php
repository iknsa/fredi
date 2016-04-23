<?php

namespace fredi\AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use fredi\AppBundle\Entity\Reason;

class LoadReason extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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

        $reason1 = new Reason;
        $reason1->setName('Gala');
        $manager->persist($reason1);

        $reason2 = new Reason;
        $reason2->setName('Compétition Internationale');
        $manager->persist($reason2);

        $reason3 = new Reason;
        $reason3->setName('Réunion');
        $manager->persist($reason3);

        $reason4 = new Reason;
        $reason4->setName('Compétition Régionale');
        $manager->persist($reason4);

        $manager->flush();

        $this->addReference('reason-1', $reason1);
        $this->addReference('reason-2', $reason2);
        $this->addReference('reason-3', $reason3);
        $this->addReference('reason-4', $reason4);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200;
    }
}