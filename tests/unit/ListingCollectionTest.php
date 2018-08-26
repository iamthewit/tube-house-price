<?php

use PHPUnit\Framework\TestCase;

use Testing\Factory\ListingFactory;
use TubeHousePrice\Listing\Currency\PoundSterling;
use TubeHousePrice\Listing\ListingCollection;
use TubeHousePrice\Listing\Price;

class ListingCollectionTest extends TestCase
{
    /**
     * @var ListingFactory $listingFactory
     */
    private $listingFactory;

    public function setUp()
    {
        $this->listingFactory = new ListingFactory();
    }

    public function testCreateCollectionFromArrayOfListings()
    {
        $listings = $this->listingFactory->createListings(10);
        $listingCollection = ListingCollection::createCollectionFromArrayOfListings($listings);
        
        $this->assertInstanceOf(ListingCollection::class, $listingCollection);
    }

    public function testItCanWorkOutTheAveragePrice()
    {
        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 100000*100);
        $listings[] = $this->listingFactory->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 200000*100);
        $listings[] = $this->listingFactory->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 300000*100);
        $listings[] = $this->listingFactory->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 400000*100);
        $listings[] = $this->listingFactory->createListingWithPrice($price);

        $price = Price::createFromCurrencyAndMinorUnitValue(new PoundSterling(), 500000*100);
        $listings[] = $this->listingFactory->createListingWithPrice($price);

        $collection = ListingCollection::createCollectionFromArrayOfListings($listings);

        $expected = ((100000 + 200000 + 300000 + 400000 + 500000) * 100) / 5;
        $this->assertEquals($expected, $collection->averagePrice());
    }
}
