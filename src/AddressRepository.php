<?php
namespace Digbang\Locations;

use Digbang\Locations\Entities\Address;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\UuidInterface;

interface AddressRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Address;

    public function findById(UuidInterface $id): ?Address;

    /**
     * @return Address[]
     */
    public function findAll();

    public function persist(Address $address): void;
}
