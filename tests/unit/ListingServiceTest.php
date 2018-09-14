<?php

use PHPUnit\Framework\TestCase;
use TubeHousePrice\Application\Config;
use TubeHousePrice\Application\DatabaseConnection\SqliteConnection;
use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Repository\SqliteListingRepository;
use TubeHousePrice\Application\Service\ListingService;
use TubeHousePrice\Listing\Geo\BoundingBox;
use TubeHousePrice\Listing\Geo\Latitude;
use TubeHousePrice\Listing\Geo\Longitude;
use TubeHousePrice\Listing\Currency\CurrencyFactory;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\ListingCollection;
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

        // delete all the listings in the table
        $this->databaseConnection()->delete('listings', []);
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

    public function testGetListingsWithinBoundingBox()
    {
        // create bounding box
        $boundingBox = new BoundingBox(
            new Longitude(-20),
            new Longitude(40),
            new Latitude(-100),
            new Latitude(50)
        );

        $longsAndLatsInsideBox = [
            [10, 10],
            [-20, 40],
            [40, -90],
        ];

        $longsAndLatsOutsideBox = [
            [-30, 10],
            [-20, 60],
            [-30, -120],
        ];

        // create some listings
        $insideIds = [];
        foreach ($longsAndLatsInsideBox as $longAndLat) {
            $entity = $this->createEntity($longAndLat[0], $longAndLat[1]);
            $insideIds[] = $entity->getId();
        }

        $outsideIds = [];
        foreach ($longsAndLatsOutsideBox as $longAndLat) {
            $entity = $this->createEntity($longAndLat[0], $longAndLat[1]);
            $outsideIds[] = $entity->getId();
        }

        $listings = $this->service->getListingsWithinBoundingBox($boundingBox);

        $this->assertEquals(3, count($listings));

        /** @var Listing $listing */
        foreach ($listings as $listing) {
            $this->assertInstanceOf(Listing::class, $listing);
            $this->assertTrue(in_array($listing->id(), $insideIds));
            $this->assertFalse(in_array($listing->id(), $outsideIds));
        }
    }

    public function testGetListings()
    {
        // seed some listings
        $count = 10;
        for ($i = 0; $i<$count; $i++) {
            $this->createEntity();
        }

        /** @var ListingCollection $listings */
        $listings = $this->service->getListings();

        $this->assertInstanceOf(ListingCollection::class, $listings);
        $this->assertEquals($count, $listings->count());
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
     * @param float|null $longitude
     * @param float|null $latitude
     *
     * @return ListingEntity
     */
    private function createEntity(float $longitude = null, float $latitude = null): ListingEntity
    {
        $listingEntity = new ListingEntity();
        $listingEntity->setId(uniqid());
        $listingEntity->setCurrencyCode('GBP');
        $listingEntity->setCurrencyMinorUnitValue($this->faker->numberBetween(0, 1000000000));

        if (!is_null($latitude)) {
            $listingEntity->setLatitude($latitude);
        } else {
            $listingEntity->setLatitude($this->faker->latitude);
        }

        if (!is_null($longitude)) {
            $listingEntity->setLongitude($longitude);
        } else {
            $listingEntity->setLongitude($this->faker->longitude);
        }

        $this->getRepository()->commit($listingEntity);

        return $listingEntity;
    }
}
