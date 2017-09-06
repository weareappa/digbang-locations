<?php
namespace Digbang\Locations;

use Digbang\Locations\Entities\Address;
use Digbang\Locations\Entities\Country;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\UuidInterface;

interface LocationRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getAddress(UuidInterface $id): Address;

    public function findAddress(UuidInterface $id): ?Address;

    /**
     * @return Address[]
     */
    public function findAll();

    public function persist(Address $address): void;
}
