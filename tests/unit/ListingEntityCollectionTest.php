
<?php

use TubeHousePrice\Application\ListingEntity;
use TubeHousePrice\Application\ListingEntityCollection;
use PHPUnit\Framework\TestCase;

class ListingEntityCollectionTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;
    
    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }
    
    public function testListings()
    {
        // create listing entity collection
        $collection = new ListingEntityCollection();
        
        // create listing entity
        $entity = $this->createEntity();
    
        // add entity to collection
        $collection->add($entity);
    
        // assert entity collection has array of entities containing added entity
        $this->assertEquals([$entity->getId() => $entity], $collection->listings());
    }
    
    public function testAdd()
    {
        // create listing entity collection
        $collection = new ListingEntityCollection();
    
        // create listing entity
        $entity = $this->createEntity();
    
        // add entity to collection
        $collection->add($entity);
        
        // assert entity collection has entity
        $this->assertArrayHasKey($entity->getId(), $collection->listings());
    }
    
    public function testRemove()
    {
        // create listing entity collection
        $collection = new ListingEntityCollection();
    
        // create listing entity
        $entity = $this->createEntity();
    
        // add entity to collection
        $collection->remove($entity);
    
        // assert entity collection does not have entity
        $this->assertArrayNotHasKey($entity->getId(), $collection->listings());
    }
    
    private function createEntity()
    {
        $entity = new ListingEntity();
        $entity->setId('1234567890');
        $entity->setCurrencyCode('GBP');
        $entity->setCurrencyMinorUnitValue(1000);
        $entity->setLatitude($this->faker->latitude);
        $entity->setLongitude($this->faker->longitude);
        
        return $entity;
    }
}
