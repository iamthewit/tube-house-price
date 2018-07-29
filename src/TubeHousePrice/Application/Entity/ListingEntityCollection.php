<?php

namespace TubeHousePrice\Application\Entity;

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
}