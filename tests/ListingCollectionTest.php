<?php

use PHPUnit\Framework\TestCase;
use TubeHousePrice\Listing\Latitude;
use TubeHousePrice\Listing\ListingCollection;
use TubeHousePrice\Listing\ListingModel;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Longitude;
use TubeHousePrice\Listing\PoundSterling;
use TubeHousePrice\Listing\Price;

class ListingCollectionTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->faker = Faker\Factory::create();
    }

    public function testCreateCollectionFromArrayOfListings()
    {
        $listingCollection = ListingCollection::createCollectionFromArrayOfListings($this->createListings(10));

        $this->assertInstanceOf(ListingCollection::class, $listingCollection);
    }
    private function createListing()
    {
        $price = Price::createFromCurrencyAndMinorUnitValue(
            new PoundSterling(),
            $this->faker->randomNumber(9)
        );

        $longitude = new Longitude($this->faker->longitude);
        $latitude = new Latitude($this->faker->latitude);
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);

        $listing = ListingModel::createFromPriceAndLocation($price, $location);

        return $listing;
    }

    private function createListings(int $number)
    {
        $listings = [];
        for($i = 0; $i < $number; $i++) {
            $listings[] = $this->createListing();
        }

        return $listings;
    }
}
