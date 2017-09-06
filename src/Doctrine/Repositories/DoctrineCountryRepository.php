<?php

namespace Digbang\Locations\Doctrine\Repositories;


use Digbang\Locations\CountryRepository;
use Digbang\Locations\Entities\Country;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class DoctrineCountryRepository extends EntityRepository implements CountryRepository
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, $em->getClassMetadata(Country::class));
    }

    public function findCountryByCode(string $code): ?Country
    {
        return $this->findOneBy(['code' => $code]);
    }
}