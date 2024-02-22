<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $profile = new Profile();
       $profile->setRs('fcb');
       $profile->setUrl('https://www.facebook.com/achrefdh09/');
       $profile1 = new Profile();
       $profile1->setRs('twitter');
       $profile1->setUrl('https://www.facebook.com/achrefdh09/');
       $profile2 = new Profile();
       $profile2->setRs('insta');
       $profile2->setUrl('https://www.facebook.com/achrefdh09/');
       $manager->persist($profile);
       $manager->persist($profile1);
       $manager->persist($profile2);
       $manager->flush();


    }
}
