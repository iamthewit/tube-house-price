<?php

namespace TubeHousePrice\Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use TubeHousePrice\Application\Service\ListingService;
use TubeHousePrice\Application\Transformer\ListingCollectionTransformer;

class ListingController extends Controller
{
    private $listingService;

    public function __construct(ListingService $listingService)
    {
        parent::__construct();
        $this->listingService = $listingService;
    }
    
    /**
     * @throws \TubeHousePrice\Application\Exception\ListingCollectionCreationException
     * @throws \TubeHousePrice\Listing\Currency\Exception\UnsupportedCurrencyException
     */
    public function index()
    {
        $listings = $this->listingService->getListings();
        $transformer = new ListingCollectionTransformer($listings);

        $response = new Response();
        $response->setContent($transformer->toJson());
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_OK);
    
        $response->send();
    }
}
