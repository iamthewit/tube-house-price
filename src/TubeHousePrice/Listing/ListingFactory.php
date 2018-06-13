<?php

namespace TubeHousePrice\Listing;

use TubeHousePrice\Application\Entity\ListingEntity;
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
}