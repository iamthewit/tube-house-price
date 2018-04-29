<?php

namespace TubeHousePrice\Listing;

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
            if (!is_a($listing, ListingModel::class)) {
                throw new ListingCollectionCreationException(
                    'Can only create a ListingCollection from ListingModel objects.'
                );
            }

            $collection->addListing($listing);
        }

        return $collection;
    }

    private function addListing(ListingModel $listing)
    {
        $this->listings[] = $listing;
    }
}