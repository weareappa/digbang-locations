<?php

namespace Digbang\Locations\Util;

use Digbang\Locations\Entities\{
    Address, AdministrativeLevel, Bounds, Coordinates, Country
};
use Geocoder\Model\AdminLevel;
use Geocoder\Model\AdminLevelCollection;

class AddressBuilder
{
    public function buildAddress(\Geocoder\Model\Address $address, ?Country $country): Address
    {
        return new Address(
            $this->buildCoordinates($address->getCoordinates()),
            $this->buildBounds($address->getBounds()),
            $address->getStreetNumber(),
            $address->getStreetName(),
            $address->getPostalCode(),
            $address->getLocality(),
            $address->getSubLocality(),
            $this->buildAdministrativeLevels($address->getAdminLevels()),
            $country?? $this->buildCountry($address->getCountry()),
            $address->getTimezone()
        );
    }

    public function buildCoordinates(\Geocoder\Model\Coordinates $coordinates): Coordinates
    {
        return new Coordinates($coordinates->getLatitude(), $coordinates->getLongitude());
    }

    public function buildCountry(\Geocoder\Model\Country $country): Country
    {
        return new Country($country->getName(), $country->getCode());
    }

    public function buildBounds(\Geocoder\Model\Bounds $bounds): Bounds
    {
        return new Bounds($bounds->getSouth(), $bounds->getWest(), $bounds->getNorth(), $bounds->getEast());
    }

    public function buildAdministrativeLevels(AdminLevelCollection $collection): array
    {
        $administrativeLevels = [];

        foreach ($collection->all() as $adminLevel) {
            $administrativeLevels[] = $this->buildAdministrativeLevel($adminLevel);
        }

        return $administrativeLevels;
    }

    public function buildAdministrativeLevel(AdminLevel $adminLevel): AdministrativeLevel
    {
        return new AdministrativeLevel($adminLevel->getLevel(), $adminLevel->getName(), $adminLevel->getCode());
    }
}
