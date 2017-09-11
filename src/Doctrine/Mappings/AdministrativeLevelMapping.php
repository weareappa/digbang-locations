<?php
namespace Digbang\Locations\Doctrine\Mappings;

use Digbang\Locations\Doctrine\Types\UuidType;
use Digbang\Locations\Entities\AdministrativeLevel;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class AdministrativeLevelMapping extends EntityMapping
{
    public function map(Fluent $builder)
    {
        // Table prefix
        $builder->table('locations_administrative_levels');

        $builder->field(UuidType::NAME, 'id')->primary();
        $builder->integer('level');
        $builder->string('name');
        $builder->string('code');
    }

    public function mapFor()
    {
        return AdministrativeLevel::class;
    }
}
