<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Phone;

class LoadPhone implements FixtureInterface
{
      public function load(ObjectManager $manager)
      {
            $phone1 = new Phone();
            $phone1->setName('Iphone 7');
            $phone1->setBrand('Apple');
            $phone1->setColor('Black');
            $phone1->setPrice('700.00');
            $manager->persist($phone1);

            $phone2 = new Phone();
            $phone2->setName('Nokia 6');
            $phone2->setBrand('Nokia');
            $phone2->setColor('Silver');
            $phone2->setPrice('249.00');
            $manager->persist($phone2);

            $phone3 = new Phone();
            $phone3->setName('BlackBerry KEY2');
            $phone3->setBrand('BlackBerry');
            $phone3->setColor('Black');
            $phone3->setPrice('649.00');
            $manager->persist($phone3);

            $phone4 = new Phone();
            $phone4->setName('Iphone 7');
            $phone4->setBrand('Apple');
            $phone4->setColor('Black');
            $phone4->setPrice('700.00');
            $manager->persist($phone4);

            $phone5 = new Phone();
            $phone5->setName('Samsung Galaxy S9');
            $phone5->setBrand('Samsung');
            $phone5->setColor('Gold');
            $phone5->setPrice('859.00');
            $manager->persist($phone5);

            $manager->flush();
      }
}