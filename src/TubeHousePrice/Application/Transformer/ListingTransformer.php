<?php

namespace TubeHousePrice\Application\Transformer;

use TubeHousePrice\Listing\Listing;

class ListingTransformer implements TransformerInterface
{
    /**
     * @var Listing $listing
     */
    private $listing;
    
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }
    
    public function toArray(): array
    {
        return [
            'id' => $this->listing->id(),
            'price' => [
                'currency_code'    => $this->listing->price()->currency()->code(),
                'currency_symbol'  => $this->listing->price()->currency()->symbol(),
                'minor_unit_value' => $this->listing->price()->minorUnitValue(),
            ],
            'location' => [
                'longitude' => $this->listing->location()->longitude()->value(),
                'latitude'  => $this->listing->location()->latitude()->value(),
            ]
        ];
    }
    
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}