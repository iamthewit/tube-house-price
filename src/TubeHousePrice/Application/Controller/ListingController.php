<?php

namespace TubeHousePrice\Application\Controller;

use TubeHousePrice\Application\Service\ListingService;
use TubeHousePrice\Application\Transformer\ListingCollectionTransformer;
use TubeHousePrice\Application\Transformer\ListingTransformer;

class ListingController
{
    private $listingService;

    public function __construct(ListingService $listingService)
    {
        $this->listingService = $listingService;
    }

    public function index()
    {
        $listings = $this->listingService->getListings();
        $transformer = new ListingCollectionTransformer($listings);

        return $transformer->toJson();
    }
}
