<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Customer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{     
      /**
       * @var ContainerInterface
       */
      private $container;

      /**
       * {@inheritdoc}
       */
      public function setContainer(ContainerInterface $container = null)
      {
            $this->container = $container;
      }


      public function load(ObjectManager $manager)
      {     

            $customer1 = new Customer();
            $customer1->setUsername('PhoneHouse');
            $customer1->setEmail('contact@phonehouse.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($customer1, 'phonehouse');
            $customer1->setPassword($password);
            $manager->persist($customer1);

            $customer2 = new Customer();
            $customer2->setUsername('HappyPhone');
            $customer2->setEmail('contact@happyphone.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($customer2, 'happyphone');
            $customer2->setPassword($password);
            $manager->persist($customer2);

            $customer3 = new Customer();
            $customer3->setUsername('Free');
            $customer3->setEmail('contact@free.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($customer3, 'free');
            $customer3->setPassword($password);
            $manager->persist($customer3);

            $customer4 = new Customer();
            $customer4->setUsername('Sfr');
            $customer4->setEmail('contact@sfr.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($customer4, 'sfr');
            $customer4->setPassword($password);
            $manager->persist($customer4);

            $user1 = new User();
            $user1->setUsername('Hassan');
            $user1->setFirstname('Hassan');
            $user1->setLastname('Doumali');
            $user1->setEmail('hassan@gmail.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($user1, 'hassan');
            $user1->setPassword($password);
            $user1->setCustomer($customer1);
            $manager->persist($user1);

            $user2 = new User();
            $user2->setUsername('Paul');
            $user2->setFirstname('Paul');
            $user2->setLastname('Wakim');
            $user2->setEmail('paul@gmail.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($user2, 'paul');
            $user2->setPassword($password);
            $user2->setCustomer($customer1);
            $manager->persist($user2);

            $user3 = new User();
            $user3->setUsername('Nicolas');
            $user3->setFirstname('Nicolas');
            $user3->setLastname('Dupont');
            $user3->setEmail('nicolas@gmail.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($user3, 'nicolas');
            $user3->setPassword($password);
            $user3->setCustomer($customer2);
            $manager->persist($user3);

            $user4 = new User();
            $user4->setUsername('Mathieu');
            $user4->setFirstname('Mathieu');
            $user4->setLastname('Claire');
            $user4->setEmail('mathieu@gmail.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($user4, 'mathieu');
            $user4->setPassword($password);
            $user4->setCustomer($customer3);
            $manager->persist($user4);

            $user5 = new User();
            $user5->setUsername('Jean');
            $user5->setFirstname('Jean');
            $user5->setLastname('Simon');
            $user5->setEmail('jean@gmail.com');
            $passwordEncoder = $this->container->get('security.password_encoder');
            $password = $passwordEncoder->encodePassword($user5, 'simon');
            $user5->setPassword($password);
            $user5->setCustomer($customer4);
            $manager->persist($user5);

            $manager->flush();
      }
}