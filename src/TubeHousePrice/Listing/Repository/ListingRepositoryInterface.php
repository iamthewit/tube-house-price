<?php

namespace TubeHousePrice\Listing\Repository;

use TubeHousePrice\Listing\ListingEntity;

interface ListingRepositoryInterface
{
    public function find($id): ListingEntity;
    
    /**
     * Commit the listing to storage.
     * Method can be used for creating or updating a resource.
     *
     * @param ListingEntity $listingEntity
     */
    public function commit(ListingEntity $listingEntity): void;
}