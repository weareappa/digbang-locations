<?php
namespace Digbang\Locations\Doctrine\Mappings;

use Digbang\Locations\Doctrine\Types\UuidType;
use Digbang\Locations\Entities\Country;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class CountryMapping extends EntityMapping
{
    public function map(Fluent $builder)
    {
        // Table prefix
        $builder->table('locations_countries');

        $builder->field(UuidType::NAME,'id')->primary();
        $builder->string('name');
        $builder->string('code')->unique();
    }

    public function mapFor()
    {
        return Country::class;
    }
}
