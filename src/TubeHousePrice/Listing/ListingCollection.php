<?php

namespace TubeHousePrice\Listing;

use Traversable;
use TubeHousePrice\Application\Exception\ListingCollectionCreationException;

class ListingCollection implements \IteratorAggregate, \Countable
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
    
    /**
     * Retrieve an external iterator
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->listings);
    }
    
    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->listings);
    }
    
    private function addListing(Listing $listing)
    {
        $this->listings[] = $listing;
    }
}