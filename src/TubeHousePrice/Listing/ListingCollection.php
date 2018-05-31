<?php

namespace TubeHousePrice\Listing;

use TubeHousePrice\Listing\Exception\ListingCollectionCreationException;

class ListingCollection
{
    private $listings;

    private function __construct(array $listings = [])
    {
        $this->listings = $listings;
    }

    /**
     * @param array $listings
     *
     * @return ListingCollection
     * @throws ListingCollectionCreationException
     */
    public static function createCollectionFromArrayOfListings(array $listings): self
    {
        $collection = new static();
        foreach ($listings as $listing) {
            if (!is_a($listing, Listing::class)) {
                throw new ListingCollectionCreationException(
                    'Can only create a ListingCollection from ListingModel objects.'
                );
            }

            $collection->addListing($listing);
        }

        return $collection;
    }

    public function averagePrice(): float
    {
        $totalPrice = 0;

        /** @var Listing $listing */
        foreach ($this->listings as $listing) {
            $totalPrice += $listing->price()->minorUnitValue();
        }

        return $totalPrice / count($this->listings);
    }

    private function addListing(Listing $listing)
    {
        $this->listings[] = $listing;
    }
}