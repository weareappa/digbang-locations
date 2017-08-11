<?php
namespace Digbang\Locations\Traits;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use Digbang\Locations\Util\UuidIdentifiable;

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
        return $this->id;
    }

    public function equalsId(UuidIdentifiable $entity): bool
    {
        return $this->getId()->equals($entity->getId());
    }
}
