<?php

use PHPUnit\Framework\TestCase;
use Testing\Factory\ListingFactory;
use TubeHousePrice\Application\Transformer\ListingTransformer;

class ListingTransformerTest extends TestCase
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
        $listing = $this->listingFactory->createListing();
        
        $transformer = new ListingTransformer($listing);
        
        $expected = [
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
        
        $this->assertEquals(json_encode($expected), $transformer->toJson());
    }
    
    public function testToArray()
    {
        $listing = $this->listingFactory->createListing();
        
        $transformer = new ListingTransformer($listing);
        
        $expected = [
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
        
        $this->assertEquals($expected, $transformer->toArray());
    }
}
