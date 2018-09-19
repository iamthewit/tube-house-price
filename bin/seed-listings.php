<?php

use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Repository\SqliteListingRepository;

require_once __DIR__.'/../src/TubeHousePrice/bootstrap.php';

$faker = Faker\Factory::create();

for ($i = 0; $i < 10; $i++) {
    $entity = new ListingEntity();
    $entity->setId($faker->uuid)
        ->setLongitude($faker->longitude)
        ->setLatitude($faker->latitude)
        ->setCurrencyCode('GBP')
        ->setCurrencyMinorUnitValue($faker->numberBetween(10000000, 100000000000));
    
    /** @var SqliteListingRepository $repository */
    $repository = $container->get('sqlite_listing_repository');
    
    echo "Seeding Listing To Database...\r\n";
    $repository->commit($entity);
}

echo "Done!\r\n";