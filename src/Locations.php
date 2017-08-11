<?php
namespace Digbang\Locations\Services;

use Geocoder\Geocoder;
use Geocoder\Model\AddressCollection;
use Geocoder\Provider\GoogleMaps;
use Ivory\HttpAdapter\HttpAdapterInterface;

class Locations
{
    /**
     * Number of AddressCollection items returned by the provider
     */
    const MAX_RESULTS = 1;

    /** @var Geocoder */
    private $geocoder;

    /** @param HttpAdapterInterface $adapter */
    public function __construct(HttpAdapterInterface $adapter)
    {
        $this->geocoder = $this->getGeocoderProvider($adapter);
        $this->geocoder->limit(static::MAX_RESULTS);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return AddressCollection
     */
    public function getByCoordinates(float $latitude, float $longitude): AddressCollection
    {
        return $this->geocoder->reverse($latitude, $longitude);
    }

    /**
     * @param string $address
     * @return \Geocoder\Model\AddressCollection
     */
    public function getByAddress(string $address): AddressCollection
    {
        return $this->geocoder->geocode($address);
    }

    /**
     * @param HttpAdapterInterface $adapter
     * @return Geocoder
     */
    protected function getGeocoderProvider(HttpAdapterInterface $adapter): Geocoder
    {
        return new GoogleMaps($adapter);
    }
}
