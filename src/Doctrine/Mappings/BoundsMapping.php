<?php
namespace Digbang\Locations\Doctrine\Mappings;

use Digbang\Locations\Entities\Bounds;
use LaravelDoctrine\Fluent\EmbeddableMapping;
use LaravelDoctrine\Fluent\Fluent;

class BoundsMapping extends EmbeddableMapping
{
    public function map(Fluent $builder)
    {
        $builder->float('south')->nullable();
        $builder->float('west')->nullable();
        $builder->float('north')->nullable();
        $builder->float('east')->nullable();
    }

    public function mapFor()
    {
        return Bounds::class;
    }
}
