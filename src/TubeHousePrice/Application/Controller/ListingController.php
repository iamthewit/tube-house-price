<?php

namespace TubeHousePrice\Application\Controller;

use TubeHousePrice\Application\Service\ListingService;
use TubeHousePrice\Application\Transformer\ListingTransformer;

class ListingController
{
    public function __construct(ListingService $listingService)
    {
        $listing = $listingService->getListingById('5b5dd966e7ffa');
        
        $transformer = new ListingTransformer($listing);
        
        echo $transformer->toJson();
    }
}