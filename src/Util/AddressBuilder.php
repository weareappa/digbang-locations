<?php
namespace Digbang\Locations\Util;

use Digbang\Locations\Entities\{
    Address, AdministrativeLevel, Coordinates, Country, Bounds
};
use Doctrine\Common\Collections\ArrayCollection;
use Geocoder\Model\AdminLevelCollection;

class AddressBuilder
{
    /**
     * @param \Geocoder\Model\Address $address
     * @return Address
     */
    public function make(\Geocoder\Model\Address $address): Address
    {
        return new Address(
            $this->makeCoordinates($address->getCoordinates()),
            $this->makeBounds($address->getBounds()),
            $address->getStreetNumber(),
            $address->getStreetName(),
            $address->getPostalCode(),
            $address->getLocality(),
            $address->getSubLocality(),
            $this->makeAdministrativeLevels($address->getAdminLevels()),
            $this->makeCountry($address->getCountry()),
            $address->getTimezone()
        );
    }

    /**
     * @param \Geocoder\Model\Coordinates $coordinates
     * @return Coordinates
     */
    protected function makeCoordinates(\Geocoder\Model\Coordinates $coordinates): Coordinates
    {
        return new Coordinates($coordinates->getLatitude(), $coordinates->getLongitude());
    }

    /**
     * @param \Geocoder\Model\Country $country
     * @return Country
     */
    protected function makeCountry(\Geocoder\Model\Country $country): Country
    {
        return new Country($country->getName(), $country->getCode());
    }

    /**
     * @param \Geocoder\Model\Bounds $bounds
     * @return Bounds
     */
    protected function makeBounds(\Geocoder\Model\Bounds $bounds): Bounds
    {
        return new Bounds($bounds->getSouth(), $bounds->getWest(), $bounds->getNorth(), $bounds->getEast());
    }

    /**
     * @param AdminLevelCollection $collection
     * @return ArrayCollection
     */
    protected function makeAdministrativeLevels(AdminLevelCollection $collection): ArrayCollection
    {
        $administrativeLevels = new ArrayCollection;

        foreach ($collection->all() as $adminLevel) {
            $administrativeLevels->add(new AdministrativeLevel($adminLevel->getLevel(), $adminLevel->getName(), $adminLevel->getCode()));
        }

        return $administrativeLevels;
    }
}
