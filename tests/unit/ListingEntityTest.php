<?php

use TubeHousePrice\Listing\ListingEntity;
use PHPUnit\Framework\TestCase;

class ListingEntityTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;
    
    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }
    
    public function testFromArray()
    {
        $fields = [
            'id'                        => $this->faker->uuid,
            'currency_code'             => $this->faker->currencyCode,
            'currency_minor_unit_value' => $this->faker->numberBetween(1000, 1000000000),
            'latitude'                  => $this->faker->latitude,
            'longitude'                 => $this->faker->longitude,
        ];
        $entity = ListingEntity::fromArray($fields);
        
        $this->assertInstanceOf(ListingEntity::class, $entity);
    }
    
    public function testAsArray()
    {
        $listingEntity = new ListingEntity();
        $listingEntity->setId(uniqid());
        $listingEntity->setCurrencyCode($this->faker->currencyCode);
        $listingEntity->setCurrencyMinorUnitValue($this->faker->numberBetween(0, 1000000000));
        $listingEntity->setLatitude($this->faker->latitude);
        $listingEntity->setLongitude($this->faker->longitude);
        
        $entityAsArray = $listingEntity->asArray();
        $expected = [
            'id'                        => $listingEntity->getId(),
            'currency_code'             => $listingEntity->getCurrencyCode(),
            'currency_minor_unit_value' => $listingEntity->getCurrencyMinorUnitValue(),
            'latitude'                  => $listingEntity->getLatitude(),
            'longitude'                 => $listingEntity->getLongitude(),
        ];
        
        $this->assertEquals($expected, $entityAsArray);
    }
}
