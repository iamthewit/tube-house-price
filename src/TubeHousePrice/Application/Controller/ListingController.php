<?php

namespace TubeHousePrice\Application\Controller;

use TubeHousePrice\Application\Repository\ListingRepositoryInterface;

class ListingController
{
    public function __construct(ListingRepositoryInterface $listingRepository)
    {
        echo "Listing Controller";
        $listingEntities = $listingRepository->findWhere(['currency_code' => 'QWERTY']);
        
        var_dump($listingEntities);
    }
}