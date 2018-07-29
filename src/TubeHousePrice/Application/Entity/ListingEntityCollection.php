<?php

namespace TubeHousePrice\Application\Entity;

use Traversable;

class ListingEntityCollection extends AbstractEntityCollection
{
    private $listings = [];
    
    public function add(ListingEntity $listing)
    {
        $this->listings[$listing->getId()] = $listing;
    }
    
    public function remove(ListingEntity $listing)
    {
        unset($this->listings[$listing->getId()]);
    }
    
    public function listings(): array
    {
        return $this->listings;
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
     * Count elements of an object
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count(): int
    {
        return count($this->listings);
    }
}