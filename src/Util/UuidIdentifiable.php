<?php
namespace Digbang\Locations\Util;

use Ramsey\Uuid\UuidInterface;

interface UuidIdentifiable
{
    /** @return UuidInterface */
    public function getId(): UuidInterface;
}
