<?php

namespace TubeHousePrice\Listing;

interface CurrencyInterface
{
    public function code(): string;

    public function name(): string;

    public function symbol(): string;
}