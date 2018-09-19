<?php

namespace TubeHousePrice\Application\Entity;

use Traversable;

abstract class AbstractEntityCollection implements \IteratorAggregate, \Countable
{
    private $items = [];
    
    public function add(EntityInterface $entity)
    {
        $this->items[$entity->getId()] = $entity;
    }
    
    public function remove(EntityInterface $entity)
    {
        unset($this->items[$entity->getId()]);
    }
    
    public function items(): array
    {
        return $this->items;
    }
    
    /**
     * Retrieve an external iterator
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }
    
    /**
     * Count elements of an object
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count(): int
    {
        return count($this->items);
    }
}