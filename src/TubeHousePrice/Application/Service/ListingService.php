<?php

namespace TubeHousePrice\Application\Service;

use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Entity\ListingEntityCollection;
use TubeHousePrice\Application\Factory\ListingEntityFactory;
use TubeHousePrice\Application\Repository\ListingRepositoryInterface;
use TubeHousePrice\Listing\Geo\BoundingBox;
use TubeHousePrice\Listing\Geo\Latitude;
use TubeHousePrice\Listing\Geo\Longitude;
use TubeHousePrice\Listing\Currency\CurrencyFactory;
use TubeHousePrice\Listing\Listing;
use TubeHousePrice\Listing\ListingCollection;
use TubeHousePrice\Listing\Location;
use TubeHousePrice\Listing\Price;

class ListingService
{
    private $listingRepository;

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

    /**
     * @param Listing $listing
     */
    public function storeListing(Listing $listing)
    {
        // turn domain object into entity
        $entity = ListingEntityFactory::createListingEntity($listing);

        // pass entity to repo to store
        $this->listingRepository->commit($entity);
    }

    /**
     * @return ListingCollection
     * @throws \TubeHousePrice\Application\Exception\ListingCollectionCreationException
     * @throws \TubeHousePrice\Application\Exception\ListingNotFoundInRepositoryException
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     */
    public function getListings(): ListingCollection
    {
        $entityCollection = $this->listingRepository->findWhere([]);

        return $this->buildListingCollectionFromListingEntityCollection($entityCollection);
    }

    /**
     * @param BoundingBox $boundingBox
     *
     * @return ListingCollection
     * @throws \TubeHousePrice\Application\Exception\ListingNotFoundInRepositoryException
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     * @throws \TubeHousePrice\Application\Exception\ListingCollectionCreationException
     */
    public function getListingsWithinBoundingBox(BoundingBox $boundingBox): ListingCollection
    {
        $entityCollection = $this->listingRepository->findWhere([
            'latitude[<>]'  => [$boundingBox->minLatitude()->value(), $boundingBox->maxLatitude()->value()],
            'longitude[<>]' => [$boundingBox->minLongitude()->value(), $boundingBox->maxLongitude()->value()],
        ]);

        return $this->buildListingCollectionFromListingEntityCollection($entityCollection);
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

    /**
     * @param ListingEntityCollection $entityCollection
     *
     * @return ListingCollection
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     * @throws \TubeHousePrice\Application\Exception\ListingCollectionCreationException
     */
    private function buildListingCollectionFromListingEntityCollection(ListingEntityCollection $entityCollection): ListingCollection
    {
        $listingArray = [];
        foreach ($entityCollection->listings() as $entity) {
            $listingArray[] = $this->buildListingFromEntity($entity);
        }

        return ListingCollection::createCollectionFromArrayOfListings($listingArray);
    }
}
