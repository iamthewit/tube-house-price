<?php

namespace TubeHousePrice\Application\Service;

use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Factory\ListingEntityFactory;
use TubeHousePrice\Application\Repository\ListingRepositoryInterface;
use TubeHousePrice\Listing\Coordinate\Latitude;
use TubeHousePrice\Listing\Coordinate\Longitude;
use TubeHousePrice\Listing\Currency\CurrencyFactory;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingService
{
    private $listingRepository;
    
    // TODO: DI
    public function __construct(ListingRepositoryInterface $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }
    
    /**
     * @param string $id
     *
     * @return Listing
     * @throws \TubeHousePrice\Application\Exception\ListingNotFoundInRepositoryException
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     */
    public function getListingById(string $id): Listing
    {
        return $this->buildListingFromEntity($this->listingRepository->find($id));
    }
    
    public function storeListing(Listing $listing)
    {
        // turn domain object into entity
        $entity = ListingEntityFactory::createListingEntity($listing);
        
        // pass entity to repo to store
        $this->listingRepository->commit($entity);
    }
    
    public function getListingsWithinBoundingBox()
    {
        // TODO: create bounding box class
        // move coordinates out of listing namespace (might as well move currency out too)
    }
    
    /**
     * Transform ListingEntity into Listing
     *
     * @param ListingEntity $listingEntity
     *
     * @return Listing
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     */
    private function buildListingFromEntity(ListingEntity $listingEntity): Listing
    {
        $currency = CurrencyFactory::build($listingEntity->getCurrencyCode());
        $price = Price::createFromCurrencyAndMinorUnitValue($currency, $listingEntity->getCurrencyMinorUnitValue());
        
        $longitude = new Longitude($listingEntity->getLongitude());
        $latitude = new Latitude($listingEntity->getLatitude());
        $location = Location::createFromLongitudeAndLatitude($longitude, $latitude);
        
        return Listing::createFromIdAndPriceAndLocation($listingEntity->getId(), $price, $location);
    }
}