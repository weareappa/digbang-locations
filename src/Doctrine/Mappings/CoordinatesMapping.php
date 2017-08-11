<?php
namespace Digbang\Locations\Doctrine\Mappings;

use Digbang\Locations\Entities\Coordinates;
use LaravelDoctrine\Fluent\EmbeddableMapping;
use LaravelDoctrine\Fluent\Fluent;

class CoordinatesMapping extends EmbeddableMapping
{
    public function map(Fluent $builder)
    {
        $builder->float('latitude');
        $builder->float('longitude');
    }

    public function mapFor()
    {
        return Coordinates::class;
    }
}
