<?php

use PHPUnit\Framework\TestCase;

use TubeHousePrice\Listing\Coordinate\Latitude;
use TubeHousePrice\Listing\Coordinate\Longitude;
use TubeHousePrice\Listing\Currency\PoundSterling;
use TubeHousePrice\Listing\ListingCollection;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingCollectionTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    public function testCreateCollectionFromArrayOfListings()
    {
        $listingCollection = ListingCollection::createCollectionFromArrayOfListings($this->createListings(10));

        $this->assertInstanceOf(ListingCollection::class, $listingCollection);
    }

    public function testItCanWorkOutTheAveragePrice()
    {
        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 100000*100);
        $listings[] = $this->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 200000*100);
        $listings[] = $this->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 300000*100);
        $listings[] = $this->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 400000*100);
        $listings[] = $this->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 500000*100);
        $listings[] = $this->createListingWithPrice($price);

        $collection = ListingCollection::createCollectionFromArrayOfListings($listings);

        $expected = ((100000 + 200000 + 300000 + 400000 + 500000) * 100) / 5;
        $this->assertEquals($expected, $collection->averagePrice());
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

        $listing = Listing::createFromPriceAndLocation($price, $location);

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

    private function createListingWithPrice(Price $price)
    {
        $longitude = new Longitude($this->faker->longitude);
        $latitude = new Latitude($this->faker->latitude);
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);

        $listing = Listing::createFromPriceAndLocation($price, $location);

        return $listing;
    }
}
