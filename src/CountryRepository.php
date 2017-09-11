<?php

namespace Digbang\Locations;


use Digbang\Locations\Entities\Country;

interface CountryRepository
{
    public function findCountryByCode(string $code): ?Country;
}