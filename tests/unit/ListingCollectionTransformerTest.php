<?php

use Testing\Factory\ListingFactory;
use TubeHousePrice\Application\Transformer\ListingCollectionTransformer;
use PHPUnit\Framework\TestCase;
use TubeHousePrice\Listing\ListingCollection;

class ListingCollectionTransformerTest extends TestCase
{
    /**
     * @var ListingFactory $listingFactory
     */
    private $listingFactory;
    
    public function setUp()
    {
        $this->listingFactory = new ListingFactory();
    }
    
    public function testToJson()
    {
        $listings = $this->listingFactory->createListings(10);
        $listingCollection = ListingCollection::createCollectionFromArrayOfListings($listings);
        
        $transformer = new ListingCollectionTransformer($listingCollection);
        
        $items = [];
        foreach ($listingCollection as $listing) {
            $items[] = [
                'id'       => $listing->id(),
                'price'    => [
                    'currency_code'    => $listing->price()->currency()->code(),
                    'currency_symbol'  => $listing->price()->currency()->symbol(),
                    'minor_unit_value' => $listing->price()->minorUnitValue(),
                ],
                'location' => [
                    'longitude' => $listing->location()->longitude()->value(),
                    'latitude'  => $listing->location()->latitude()->value(),
                ]
            ];
        }
        
        $this->assertEquals(json_encode(['items' => $items]), $transformer->toJson());
    }
    
    public function testToArray()
    {
        $listings = $this->listingFactory->createListings(10);
        $listingCollection = ListingCollection::createCollectionFromArrayOfListings($listings);
    
        $transformer = new ListingCollectionTransformer($listingCollection);
    
        $items = [];
        foreach ($listingCollection as $listing) {
            $items[] = [
                'id'       => $listing->id(),
                'price'    => [
                    'currency_code'    => $listing->price()->currency()->code(),
                    'currency_symbol'  => $listing->price()->currency()->symbol(),
                    'minor_unit_value' => $listing->price()->minorUnitValue(),
                ],
                'location' => [
                    'longitude' => $listing->location()->longitude()->value(),
                    'latitude'  => $listing->location()->latitude()->value(),
                ]
            ];
        }
    
        $this->assertEquals(['items' => $items], $transformer->toArray());
    }
    
    
}
