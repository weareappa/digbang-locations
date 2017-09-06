<?php

namespace Digbang\Locations\Util;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

trait Identity
{
    /** @var UuidInterface */
    protected $id;

    protected function initializeId()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }

    public function equalsId(UuidIdentifiable $entity): bool
    {
        return $this->getId()->equals($entity->getId());
    }
}
