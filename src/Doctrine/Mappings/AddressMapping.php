<?php

namespace Digbang\Locations\Doctrine\Mappings;

use Digbang\Locations\Doctrine\Types\UuidType;
use Digbang\Locations\Entities\Address;
use Digbang\Locations\Entities\AdministrativeLevel;
use Digbang\Locations\Entities\Bounds;
use Digbang\Locations\Entities\Coordinates;
use Digbang\Locations\Entities\Country;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class AddressMapping extends EntityMapping
{
    public function map(Fluent $builder)
    {
        // Table prefix
        $builder->table('locations_addresses');

        $builder->field(UuidType::NAME, 'id')->primary();
        $builder->string('streetNumber')->nullable();
        $builder->string('streetName')->nullable();
        $builder->string('locality')->nullable();
        $builder->string('subLocality')->nullable();
        $builder->string('postalCode')->nullable();
        $builder->string('timezone')->nullable();

        // Embeddables
        $builder->embed(Coordinates::class, 'coordinates')->noPrefix();
        $builder->embed(Bounds::class, 'bounds')->noPrefix();

        // Relationships
        $builder->manyToOne(Country::class, 'country')->cascadePersist();
        $builder->manyToMany(AdministrativeLevel::class, 'administrativeLevels')->cascadePersist();
    }

    public function mapFor()
    {
        return Address::class;
    }
}
