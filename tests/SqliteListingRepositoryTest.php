<?php

use PHPUnit\Framework\TestCase;

use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Listing\ListingEntity;
use TubeHousePrice\Listing\Repository\SqliteListingRepository;

class SqliteListingRepositoryTest extends TestCase
{
//    public function testFind()
//    {
//
//    }
//
//    public function testAsArray()
//    {
//
//    }

    public function testCommitInsertsNewRecord()
    {
        $faker = \Faker\Factory::create();

        $listingRepository = new SqliteListingRepository($this->databaseConnection());
        
        $listingEntity = new ListingEntity();
        $listingEntity->setId(uniqid());
        $listingEntity->setCurrencyCode($faker->currencyCode);
        $listingEntity->setCurrencyMinorUnitValue($faker->numberBetween(0, 1000000000));
        $listingEntity->setLatitude($faker->latitude);
        $listingEntity->setLongitude($faker->longitude);

        $listingRepository->commit($listingEntity);

        $dbHasRecord = $this->databaseConnection()->has('listings', ['id' => $listingEntity->getId()]);
        $this->assertTrue($dbHasRecord);
    }

    public function testCommitUpdatesExistingRecord()
    {
        $faker = \Faker\Factory::create();
    
        $listingRepository = new SqliteListingRepository($this->databaseConnection());
    
        $listingEntity = new ListingEntity();
        $listingEntity->setId(uniqid());
        $listingEntity->setCurrencyCode($faker->currencyCode);
        $listingEntity->setCurrencyMinorUnitValue($faker->numberBetween(0, 1000000000));
        $listingEntity->setLatitude($faker->latitude);
        $listingEntity->setLongitude($faker->longitude);
    
        $listingRepository->commit($listingEntity);
    
        $listingEntity->setCurrencyCode('QWERTY');

        $listingRepository->commit($listingEntity);

        $dbHasRecord = $this->databaseConnection()->has('listings', ['currency_code' => 'QWERTY']);
        $this->assertTrue($dbHasRecord);
    }

    /**
     * @return SqliteConnection
     */
    private function databaseConnection(): SqliteConnection {
        return new SqliteConnection(__DIR__.'/../resources/sqlite/database/tube_house_prices.db');
    }

}
