<?php

use TubeHousePrice\Listing\Latitude;
use TubeHousePrice\Listing\ListingModel;
use PHPUnit\Framework\TestCase;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Longitude;
use TubeHousePrice\Listing\PoundSterling;
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
