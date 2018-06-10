<?php

namespace TubeHousePrice\Listing;

use TubeHousePrice\Listing\Currency\CurrencyFactory;

class ListingFactory
{
    /**
     * Transform ListingEntity into Listing
     *
     * @param ListingEntity $listingEntity
     *
     * @return Listing
     * @throws Currency\Exception\UnsupportedCurrencyException
     */
    public static function createListing(ListingEntity $listingEntity): Listing
    {
        $currency = CurrencyFactory::build($listingEntity->getCurrencyCode());
        $price = Price::createFromCurrencyAndMinorUnitValue($currency, $listingEntity->getCurrencyMinorUnitValue());
        $location = Location::createFromLongitudeAndLatitude($listingEntity->getLongitude(), $listingEntity->getLatitude());
        
        return Listing::createFromIdAndPriceAndLocation($listingEntity->getId(), $price, $location);
    }
    
    /**
     * Transform Listing into ListingEntity
     *
     * @param Listing $listing
     *
     * @return ListingEntity
     */
    public static function createListingEntity(Listing $listing)
    {
        $listingEntity = new ListingEntity();
        $listingEntity->setId($listing->id());
        $listingEntity->setCurrencyCode($listing->price()->currency()->code());
        $listingEntity->setCurrencyMinorUnitValue($listing->price()->minorUnitValue());
        $listingEntity->setLongitude($listing->location()->longitude());
        $listingEntity->setLatitude($listing->location()->latitude());
        
        return $listingEntity;
    }
}