<?php

namespace TubeHousePrice\Application\Repository;

use TubeHousePrice\Application\Entity\ListingEntity;
use TubeHousePrice\Application\Entity\ListingEntityCollection;
use TubeHousePrice\Application\Exception\ListingNotFoundInRepositoryException;

interface ListingRepositoryInterface
{
    /**
     * @param $id
     *
     * @return ListingEntity
     * @throws ListingNotFoundInRepositoryException
     */
    public function find($id): ListingEntity;
    
    /**
     * @param array $where
     *
     * @return ListingEntityCollection
     * @throws ListingNotFoundInRepositoryException
     */
    public function findWhere(array $where): ListingEntityCollection;
    
    /**
     * Commit the listing to storage.
     * Method can be used for creating or updating a resource.
     *
     * @param ListingEntity $listingEntity
     */
    public function commit(ListingEntity $listingEntity): void;
}