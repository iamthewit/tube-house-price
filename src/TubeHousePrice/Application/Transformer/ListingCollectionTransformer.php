<?php

namespace TubeHousePrice\Application\Transformer;

use TubeHousePrice\Listing\ListingCollection;

class ListingCollectionTransformer implements TransformerInterface
{
    /**
     * @var ListingCollection $collection
     */
    private $collection;
    
    public function __construct(ListingCollection $collection)
    {
        $this->collection = $collection;
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        $items = [];
        foreach ($this->collection as $listing) {
            $listingTransformer = new ListingTransformer($listing);
            $items[] = $listingTransformer->toArray();
        }
        
        return [
            'items' => $items,
        ];
    }
    
    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}