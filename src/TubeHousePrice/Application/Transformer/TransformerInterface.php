<?php

namespace TubeHousePrice\Application\Transformer;

interface TransformerInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
    
    /**
     * @return string
     */
    public function toJson(): string;
}