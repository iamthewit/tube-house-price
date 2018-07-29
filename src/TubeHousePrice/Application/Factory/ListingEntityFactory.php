<?php

namespace TubeHousePrice\Application\Factory;

use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Listing\Listing;

class ListingEntityFactory
{
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
        $listingEntity->setLongitude($listing->location()->longitude()->value());
        $listingEntity->setLatitude($listing->location()->latitude()->value());
        
        return $listingEntity;
    }
}