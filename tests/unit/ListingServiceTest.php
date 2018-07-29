<?php

use PHPUnit\Framework\TestCase;
use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Repository\SqliteListingRepository;
use TubeHousePrice\Application\Service\ListingService;
use TubeHousePrice\Listing\Coordinate\Latitude;
use TubeHousePrice\Listing\Coordinate\Longitude;
use TubeHousePrice\Listing\Currency\CurrencyFactory;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\Price;

class ListingServiceTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;
    
    /**
     * @var ListingService
     */
    private $service;
    
    public function setUp()
    {
        $this->faker = Faker\Factory::create();
        $this->service = new ListingService($this->getRepository());
    }
    
    public function testGetListingById()
    {
        // create listing
        $entity = $this->createEntity();
        
        $listing = $this->service->getListingById($entity->getId());
        
        $this->assertInstanceOf(Listing::class, $listing);
        $this->assertEquals($listing->id(), $entity->getId());
    }
    
    public function testStoreListing()
    {
        $currency = CurrencyFactory::build('GBP');
        $price = Price::createFromCurrencyAndMinorUnitValue($currency, 100000000);
        
        $longitude = new Longitude($this->faker->longitude);
        $latitude = new Latitude($this->faker->latitude);
        $location = \TubeHousePrice\Listing\Location::createFromLongitudeAndLatitude($longitude, $latitude);
        
        $listing = Listing::createFromPriceAndLocation($price, $location);
        
        $this->service->storeListing($listing);
        
        $entity = $this->getRepository()->find($listing->id());
        
        $this->assertInstanceOf(ListingEntity::class, $entity);
        $this->assertEquals($entity->getId(), $listing->id());
    }
    
    /**
     * @return SqliteConnection
     */
    private function databaseConnection(): SqliteConnection {
        $pathToDatabase = getenv('PROJECT_ROOT_PATH').getenv('SQLITE_DATABASE_PATH');
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
        $listingEntity->setCurrencyCode('GBP');
        $listingEntity->setCurrencyMinorUnitValue($this->faker->numberBetween(0, 1000000000));
        $listingEntity->setLatitude($this->faker->latitude);
        $listingEntity->setLongitude($this->faker->longitude);
        
        $this->getRepository()->commit($listingEntity);
        
        return $listingEntity;
    }
}
