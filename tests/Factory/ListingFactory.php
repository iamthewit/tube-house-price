<?php

namespace Testing\Factory;

use TubeHousePrice\Listing\Currency\PoundSterling;
use TubeHousePrice\Listing\Geo\Latitude;
use TubeHousePrice\Listing\Geo\Longitude;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingFactory
{
    /** @var \Faker\Generator */
    private $faker;
    
    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }
    
    /**
     * @return Listing
     */
    public function createListing(): Listing
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
    
    /**
     * @param int $number
     *
     * @return array
     */
    public function createListings(int $number): array
    {
        $listings = [];
        for($i = 0; $i < $number; $i++) {
            $listings[] = $this->createListing();
        }
        
        return $listings;
    }
    
    /**
     * @param Price $price
     *
     * @return Listing
     */
    public function createListingWithPrice(Price $price): Listing
    {
        $longitude = new Longitude($this->faker->longitude);
        $latitude = new Latitude($this->faker->latitude);
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);
        
        $listing = Listing::createFromPriceAndLocation($price, $location);
        
        return $listing;
    }
}