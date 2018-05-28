<?php

namespace TubeHousePrice\Listing\Currency;

interface CurrencyInterface
{
    public function code(): string;

    public function name(): string;

    public function symbol(): string;
}