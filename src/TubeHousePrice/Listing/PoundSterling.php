<?php

namespace TubeHousePrice\Listing;

class PoundSterling implements CurrencyInterface
{
    public function code(): string
    {
        return 'GBP';
    }

    public function name(): string
    {
        return 'Pound Sterling';
    }

    public function symbol(): string
    {
        return '£';
    }

}