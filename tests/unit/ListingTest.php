<?php

use PHPUnit\Framework\TestCase;

use TubeHousePrice\Listing\Geo\Latitude;
use TubeHousePrice\Listing\Geo\Longitude;
use TubeHousePrice\Listing\Currency\PoundSterling;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingTest extends TestCase
{
    public function testListingIsCreateFromPriceAndLocation()
    {
        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 500000*100);

        $longitude = new Longitude('-0.118092');
        $latitude = new Latitude('51.509865');
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);

        $listing = Listing::createFromPriceAndLocation($price, $location);

        $this->assertInstanceOf(Listing::class, $listing);
    }
}
