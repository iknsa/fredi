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
        
        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('noreply.fredi@gmail.com');
        $admin->setPlainPassword('admin');
        $admin->setEnabled(true);
        $admin->setLastLogin(new \Datetime('NOW'));
        $admin->setRoles(array('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_TREASURER'));
        $manager->persist($admin);

        $member = $userManager->createUser();
        $member->setUsername('member');
        $member->setEmail('kosseyla.hamouche@gmail.com');
        $member->setPlainPassword('member');
        $member->setEnabled(true);
        $member->setLastLogin(new \Datetime('NOW'));
        $member->setRoles(array('ROLE_MEMBER'));
        $manager->persist($member);

        $treasurer = $userManager->createUser();
        $treasurer->setUsername('treasurer');
        $treasurer->setEmail('treasurer@fredi.com');
        $treasurer->setPlainPassword('treasurer');
        $treasurer->setEnabled(true);
        $treasurer->setLastLogin(new \Datetime('NOW'));
        $treasurer->setRoles(array('ROLE_TREASURER'));
        $manager->persist($treasurer);
        $manager->flush();

        $this->addReference('admin-admin', $admin);
        $this->addReference('member-member', $member);
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
