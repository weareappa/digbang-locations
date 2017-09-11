<?php

namespace Digbang\Locations;

use Digbang\Locations\Entities\Address;
use Digbang\Locations\Util\AddressBuilder;
use Geocoder\Collection;
use Geocoder\Provider\Provider;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

class Locations
{
    /** @var Provider */
    private $provider;
    /**
     * @var AddressBuilder
     */
    private $addressBuilder;
    /**
     * @var LocationRepository
     */
    private $repository;
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    public function __construct(
        Provider $provider,
        LocationRepository $repository,
        AddressBuilder $addressBuilder,
        CountryRepository $countryRepository
    ) {
        $this->provider = $provider;
        $this->addressBuilder = $addressBuilder;
        $this->repository = $repository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return Address[]
     */
    public function getByCoordinates(float $latitude, float $longitude)
    {
        $query = ReverseQuery::fromCoordinates($latitude, $longitude)
            ->withData('result_type', 'street_address');
        $collection = $this->provider->reverseQuery($query);

        return $this->mapCollection($collection);
    }

    /**
     * @return Address[]
     */
    public function getByAddress(string $address)
    {
        $query = GeocodeQuery::create($address)->withData('result_type', 'street_address');;
        $collection = $this->provider->geocodeQuery($query);

        return $this->mapCollection($collection);
    }

    /**
     * @return Address[]
     */
    private function mapCollection(Collection $collection): array
    {
        return array_map(function (\Geocoder\Model\Address $address) {
            $country = $this->countryRepository->findCountryByCode($address->getCountry()->getCode());
            return $this->addressBuilder->buildAddress($address, $country);
        },
            $collection->all());
    }
}
