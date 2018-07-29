<?php

namespace TubeHousePrice\Application\Controller;

use TubeHousePrice\Application\Service\ListingService;

class ListingController
{
    public function __construct(ListingService $listingService)
    {
        echo "Listing Controller";
        $listing = $listingService->getListingById('5b5db22d9fa94');
        
        var_dump($listing);
    }
}