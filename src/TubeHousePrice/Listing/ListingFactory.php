<?php

namespace TubeHousePrice\Listing;

class ListingFactory
{
    // transform ListingEntity into Listing
    public static function createListing(ListingEntity $listingEntity): Listing
    {
        // TODO: create currency code to currency class factory
        $currency = new Currency\PoundSterling;
        $price = Price::createFromCurrencyAndMinorUnitValue($currency, $listingEntity->getCurrencyMinorUnitValue());
        $location = Location::createFromLongitudeAndLatitude($listingEntity->getLongitude(), $listingEntity->getLatitude());
        
        return Listing::createFromIdAndPriceAndLocation($listingEntity->getId(), $price, $location);
    }
    
    public static function createListingEntity(Listing $listing)
    {
        // TODO
    }
}