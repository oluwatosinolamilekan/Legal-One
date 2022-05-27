<?php

namespace App\DataFixtures;

use App\Entity\Log;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $collections = [
            [  'name'=> 'USER-SERVICE',
                'date' => '17/Aug/2021:09:21:53 +0000',
                'status' => 201,
                'method' => 'GET',
                'endpoint' => '/users'
            ],
            [  'name'=> 'INVOICE-SERVICE ',
                'date' => '17/Aug/2021:09:21:53 +0000',
                'status' => 201,
                'method' => 'GET',
                'endpoint' => '/users'
            ],
            [  'name'=> 'USER-SERVICE',
                'date' => '18/Aug/2021:09:21:53 +0000',
                'status' => 201,
                'method' => 'GET',
                'endpoint' => '/users'
            ],
            [  'name'=> 'INVOICE-SERVICE ',
                'date' => '18/Aug/2021:09:21:53 +0000',
                'status' => 201,
                'method' => 'GET',
                'endpoint' => '/users'
            ],
        ];

        foreach ($collections as $collection){
            $log = new Log();
            $log->setName($collection['name']);
            $log->setDate($collection['date']);
            $log->setStatus($collection['status']);
            $log->setMethod($collection['method']);
            $log->setEndpoint($collection['endpoint']);
            $manager->persist($log);
        }

        $manager->flush();
    }
}
