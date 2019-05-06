<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->encoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName("SuperAdmin");
        $role->setSymfonyName("ROLE_ROOT");
        $role->setColor("#FF0000");
        $manager->persist($role);
        $manager->flush();

        /** @var Role[] $roles */
        $roles= array();
        $roles[] = $role->getSymfonyName();

        $account = new Account();
        $account->setUsername("root");
        $account->setEmail("jovanndeveloppeur@gmail.com");
        $account->setCreateAt(new \DateTime());
        $account->setRoles($roles);
        $account->setPassword($this->encoder->encodePassword($account,"root"));
        $manager->persist($account);
        $manager->flush();
    }
}
