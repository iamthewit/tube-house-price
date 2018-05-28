<?php

use PHPUnit\Framework\TestCase;

use TubeHousePrice\Listing\Coordinate\Latitude;
use TubeHousePrice\Listing\Coordinate\Longitude;
use TubeHousePrice\Listing\Currency\PoundSterling;
use TubeHousePrice\Listing\ListingModel;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingModelTest extends TestCase
{
    public function testListingModelIsCreateFromPriceAndLocation()
    {
        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 500000*100);

        $longitude = new Longitude('	-0.118092');
        $latitude = new Latitude('	51.509865');
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);

        $listing = ListingModel::createFromPriceAndLocation($price, $location);

        $this->assertInstanceOf(ListingModel::class, $listing);
    }
}
