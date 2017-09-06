<?php
namespace Digbang\Locations\Doctrine\Repositories;

use Digbang\Locations\Entities\Country;
use Digbang\Locations\Util\AddressBuilder;
use Digbang\Locations\LocationRepository;
use Digbang\Locations\Entities\Address;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

class DoctrineLocationRepository extends EntityRepository implements LocationRepository
{
    /** @var AddressBuilder */
    private $builder;

    public function __construct(EntityManager $em, AddressBuilder $builder)
    {
        parent::__construct($em, $em->getClassMetadata(Address::class));

        $this->builder = $builder;
    }

    public function getAddress(UuidInterface $id): Address
    {
        /** @var null|Address $address */
        $address = $this->find($id);

        if (is_null($address)) {
            throw new EntityNotFoundException('Entity not found.');
        }

        return $address;
    }

    public function findAddress(UuidInterface $id): ?Address
    {
        /** @var null|Address $address */
        $address = $this->find($id);

        return $address;
    }

    public function persist(Address $address): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($address);
        $entityManager->flush($address);
    }

    public function remove(Address $address): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->remove($address);
        $entityManager->flush($address);
    }

    public function findCountryByCode(string $code): ?Country
    {
    }
}
