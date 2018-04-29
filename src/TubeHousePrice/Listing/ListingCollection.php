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

    public function averagePrice(): float
    {
        $totalPrice = 0;

        /** @var ListingModel $listing */
        foreach ($this->listings as $listing) {
            $totalPrice += $listing->price()->minorUnitValue();
        }

        return $totalPrice / count($this->listings);
    }

    private function addListing(ListingModel $listing)
    {
        $this->listings[] = $listing;
    }
}