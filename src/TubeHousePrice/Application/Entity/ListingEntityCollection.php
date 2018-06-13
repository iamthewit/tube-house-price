<?php

namespace TubeHousePrice\Application\Entity;

class ListingEntityCollection
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
    
    public function listings()
    {
        return $this->listings;
    }
}