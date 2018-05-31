<?php

namespace TubeHousePrice\Application;

use TubeHousePrice\Listing\Repository\ListingRepositoryInterface;

class ListingController
{
    public function __construct(ListingRepositoryInterface $listingRepository)
    {
        echo "Listing Controller";
    }
}