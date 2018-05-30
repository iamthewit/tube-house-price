<?php

use Medoo\Medoo;
use PHPUnit\Framework\TestCase;

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

        $listingRepository = new SqliteListingRepository(
            uniqid(),
            $faker->currencyCode,
            $faker->numberBetween(0, 1000000000),
            $faker->latitude,
            $faker->longitude
        );

        $listingRepository->commit();

        $dbHasRecord = $this->databaseConnection()->has('listings', ['id' => $listingRepository->getId()]);
        $this->assertTrue($dbHasRecord);
    }

    public function testCommitUpdatesExistingRecord()
    {
        $faker = \Faker\Factory::create();

        $listingRepository = new SqliteListingRepository(
            uniqid(),
            $faker->currencyCode,
            $faker->numberBetween(0, 1000000000),
            $faker->latitude,
            $faker->longitude
        );

        $listingRepository->commit();

        $listingRepository->setCurrencyCode('QWERTY');

        $listingRepository->commit();

        $dbHasRecord = $this->databaseConnection()->has('listings', ['currency_code' => 'QWERTY']);
        $this->assertTrue($dbHasRecord);
    }

    /**
     * @return Medoo
     */
    private function databaseConnection(): Medoo {
        return new Medoo([
            'database_type' => 'sqlite',
            'database_file' => __DIR__.'/../resources/sqlite/database/tube_house_prices.db',
        ]);
    }

}
