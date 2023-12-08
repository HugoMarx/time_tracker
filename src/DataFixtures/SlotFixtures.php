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

        for ($i = 0; $i < $slotCount; $i++) {

            $slot = new Slot();
            $date = new DateTimeImmutable('today +' . $i . 'day');

            $slot->setDate($date)
            ->setStartTime($date->modify('+ 22 hours 30 minutes'))
            ->setEndTime($date->modify('+ 30 hours'))
            ->setTotalTime(60*2);

            $manager->persist($slot);
            
        }
     
        $manager->flush();
    }
}
