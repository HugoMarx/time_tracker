<?php

namespace App\DataFixtures;

use App\Entity\Slot;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SlotFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $slotCount = 14;

        $duration = [240, 320, 380, 440, 500, 560, 620];

        for ($i = 0; $i < $slotCount; $i++) {

            $slot = new Slot();
            $date = new DateTimeImmutable('today +' . $i . 'day');

            $slot->setDate($date)
            ->setStartTime($date->modify('+ 22 hours 30 minutes'))
            ->setEndTime($date->modify('+ 30 hours'))
            ->setTotalTime($duration[array_rand($duration)]);

            $manager->persist($slot);
            
        }
     
        $manager->flush();
    }
}
