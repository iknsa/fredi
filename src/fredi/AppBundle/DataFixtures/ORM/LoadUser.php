<?php
namespace fredi\AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class LoadUser extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $userManager = $this->getContainer->get('fos_user.user_manager');
        
        $member1 = $userManager->createUser();
        $member1->setUsername('nathan');
        $member1->setEmail('nathan.lievin@gmail.com');
        $member1->setPlainPassword('nathanlievin');
        $member1->setEnabled(true);
        $member1->setLastLogin(new \Datetime('NOW'));
        $member1->setRoles(array('ROLE_MEMBER'));
        $manager->persist($member1);

        $member2 = $userManager->createUser();
        $member2->setUsername('lea');
        $member2->setEmail('lea.silbert@gmail.com');
        $member2->setPlainPassword('leasilbert');
        $member2->setEnabled(true);
        $member2->setLastLogin(new \Datetime('NOW'));
        $member2->setRoles(array('ROLE_MEMBER'));
        $manager->persist($member2);

        $treasurer = $userManager->createUser();
        $treasurer->setUsername('treasurer');
        $treasurer->setEmail('treasurer@m2l.com');
        $treasurer->setPlainPassword('treasurer');
        $treasurer->setEnabled(true);
        $treasurer->setLastLogin(new \Datetime('NOW'));
        $treasurer->setRoles(array('ROLE_TREASURER'));
        $manager->persist($treasurer);
        $manager->flush();

        $this->addReference('member-member1', $member1);
        $this->addReference('member-member2', $member2);
        $this->addReference('treasurer-treasurer', $treasurer);
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }
}
