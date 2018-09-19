<?php

use PHPUnit\Framework\TestCase;

use TubeHousePrice\Application\Config;
use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Entity\ListingEntityCollection;
use TubeHousePrice\Application\Repository\SqliteListingRepository;

class SqliteListingRepositoryTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    
        // delete all the listings in the table
        $this->databaseConnection()->delete('listings', []);
    }
    
    /**
     * @throws \TubeHousePrice\Application\Exception\ListingNotFoundInRepositoryException
     */
    public function testFind()
    {
        $listingRepository = $this->getRepository();

        $listingEntity = $this->createEntity();

        $listingRepository->commit($listingEntity);

        $foundEntity = $listingRepository->find($listingEntity->getId());

        $this->assertEquals($listingEntity, $foundEntity);
    }

    public function testFindWhere()
    {
        $listingRepository = $this->getRepository();

        $listingEntity = $this->createEntity();

        $listingRepository->commit($listingEntity);

        $foundEntities = $listingRepository->findWhere(['latitude' => $listingEntity->getLatitude()]);

        $this->assertInstanceOf(ListingEntityCollection::class, $foundEntities);
        $this->assertEquals($listingEntity, $foundEntities->items()[$listingEntity->getId()]);
    }
    
    public function testFindWhereReturnsEmptyArrayWhenNoListingsCanBeFound()
    {
        $listingRepository = $this->getRepository();
        
        $foundEntities = $listingRepository->findWhere([]);
        
        $this->assertInstanceOf(ListingEntityCollection::class, $foundEntities);
        $this->assertEquals([], $foundEntities->items());
    }

    public function testCommitInsertsNewRecord()
    {
        $listingRepository = $this->getRepository();

        $listingEntity = $this->createEntity();

        $listingRepository->commit($listingEntity);

        $dbHasRecord = $this->databaseConnection()->has('listings', ['id' => $listingEntity->getId()]);
        $this->assertTrue($dbHasRecord);
    }

    public function testCommitUpdatesExistingRecord()
    {
        $listingRepository = $this->getRepository();

        $listingEntity = $this->createEntity();

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
        $dbPath = Config::get('paths.sqlite_database');
        $pathToDatabase = $dbPath.'/'.getenv('SQLITE_DATABASE_FILENAME');

        return new SqliteConnection($pathToDatabase);
    }

    /**
     * @return SqliteListingRepository
     */
    private function getRepository(): SqliteListingRepository
    {
        $listingRepository = new SqliteListingRepository($this->databaseConnection());
        return $listingRepository;
    }

    /**
     * @return ListingEntity
     */
    private function createEntity(): ListingEntity
    {
        $listingEntity = new ListingEntity();
        $listingEntity->setId(uniqid());
        $listingEntity->setCurrencyCode($this->faker->currencyCode);
        $listingEntity->setCurrencyMinorUnitValue($this->faker->numberBetween(0, 1000000000));
        $listingEntity->setLatitude($this->faker->latitude);
        $listingEntity->setLongitude($this->faker->longitude);
        return $listingEntity;
    }
}
