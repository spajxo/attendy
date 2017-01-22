<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('spajx');
        $userAdmin->setPlainPassword('spajx');
        $userAdmin->setEmail('spajxo@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}