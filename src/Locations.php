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

    public function __construct(Provider $provider, LocationRepository $repository, AddressBuilder $addressBuilder)
    {
        $this->provider = $provider;
        $this->addressBuilder = $addressBuilder;
        $this->repository = $repository;
    }

    /**
     * @return Address[]
     */
    public function getByCoordinates(float $latitude, float $longitude)
    {
        $collection = $this->provider->reverseQuery(ReverseQuery::fromCoordinates($latitude, $longitude));

        return $this->mapCollection($collection);
    }

    /**
     * @return Address[]
     */
    public function getByAddress(string $address)
    {
        $collection = $this->provider->geocodeQuery(GeocodeQuery::create($address));

        return $this->mapCollection($collection);
    }

    /**
     * @return Address[]
     */
    private function mapCollection(Collection $collection): array
    {
        return array_map(function (\Geocoder\Model\Address $address) {
            return $this->addressBuilder->buildAddress($address);
        }, $collection->all());
    }
}
