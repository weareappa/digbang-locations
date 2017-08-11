<?php
namespace Digbang\Locations\Entities;

use Digbang\Locations\Traits\Identity;
use Doctrine\Common\Collections\ArrayCollection;

class Address
{
    use Identity;

    /** @var Coordinates */
    private $coordinates;

    /** @var Bounds */
    private $bounds;

    /** @var string */
    private $streetNumber;

    /** @var string */
    private $streetName;

    /** @var string */
    private $subLocality;

    /** @var string */
    private $locality;

    /** @var string */
    private $postalCode;

    /** @var AdministrativeLevel[]|ArrayCollection */
    private $administrativeLevels;

    /** @var Country */
    private $country;

    /** @var string */
    private $timezone;

    /**
     * Address constructor.
     * @param Coordinates|null $coordinates
     * @param Bounds|null $bounds
     * @param null $streetNumber
     * @param null $streetName
     * @param null $postalCode
     * @param null $locality
     * @param null $subLocality
     * @param null|array $administrativeLevels
     * @param Country|null $country
     * @param null $timezone
     */
    public function __construct(
        Coordinates $coordinates = null,
        Bounds $bounds  = null,
        $streetNumber = null,
        $streetName  = null,
        $postalCode = null,
        $locality = null,
        $subLocality = null,
        array $administrativeLevels = null,
        Country $country = null,
        $timezone = null
    ) {
        $this->coordinates = $coordinates;
        $this->bounds = $bounds;
        $this->streetNumber = $streetNumber;
        $this->streetName = $streetName;
        $this->postalCode = $postalCode;
        $this->locality = $locality;
        $this->subLocality = $subLocality;
        $this->administrativeLevels = !empty($administrativeLevels) ? new ArrayCollection($administrativeLevels) : [];
        $this->country = $country;
        $this->timezone = $timezone;
    }

    /**
     * @param Coordinates $coordinates
     * @return Address
     */
    public function setCoordinates(Coordinates $coordinates): self
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * @param Bounds $bounds
     * @return Address
     */
    public function setBounds(Bounds $bounds): self
    {
        $this->bounds = $bounds;
        return $this;
    }

    /**
     * @param string $streetNumber
     * @return Address
     */
    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @param string $streetName
     * @return Address
     */
    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @param string $locality
     * @return Address
     */
    public function setLocality(string $locality): self
    {
        $this->locality = $locality;
        return $this;
    }

    /**
     * @param string $subLocality
     * @return Address
     */
    public function setSubLocality(string $subLocality): self
    {
        $this->subLocality = $subLocality;
        return $this;
    }

    /**
     * @param $administrativeLevels
     * @return Address
     */
    public function setAdministrativeLevels($administrativeLevels): self
    {
        if ($administrativeLevels instanceof ArrayCollection) {
            $this->administrativeLevels = $administrativeLevels;
        } else {
            $this->administrativeLevels->clear();

            foreach ($administrativeLevels as $administrativeLevel) {
                $this->administrativeLevels->add($administrativeLevel);
            }
        }

        return $this;
    }

    /**
     * @param Country $country
     * @return Address
     */
    public function setCountry(Country $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string $timezone
     * @return Address
     */
    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Returns an array of coordinates (latitude, longitude).
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * Returns the latitude value.
     * @return float
     */
    public function getLatitude(): float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return (float)$this->coordinates->getLatitude();
    }

    /**
     * Returns the longitude value.
     * @return float
     */
    public function getLongitude(): float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return (float)$this->coordinates->getLongitude();
    }

    /**
     * Returns the bounds value.
     * @return Bounds
     */
    public function getBounds(): Bounds
    {
        return $this->bounds;
    }

    /**
     * Returns the street number value.
     * @return string
     */
    public function getStreetNumber(): string
    {
        return (string)$this->streetNumber;
    }

    /**
     * Returns the street name value.
     * @return string
     */
    public function getStreetName(): string
    {
        return (string)$this->streetName;
    }

    /**
     * Returns the city or locality value.
     * @return string
     */
    public function getLocality(): string
    {
        return (string)$this->locality;
    }

    /**
     * Returns the postal code or zipcode value.
     * @return string
     */
    public function getPostalCode(): string
    {
        return (string)$this->postalCode;
    }

    /**
     * Returns the locality district, or sublocality, or neighborhood.
     * @return string
     */
    public function getSubLocality(): string
    {
        return (string)$this->subLocality;
    }

    /**
     * Returns the administrative levels.
     * @return AdministrativeLevel[]
     */
    public function getAdminLevels(): array
    {
        return $this->administrativeLevels->getValues();
    }

    /**
     * Returns the country value.
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * Returns the country ISO code.
     * @return string
     */
    public function getCountryCode(): string
    {
        return (string)$this->country->getCode();
    }

    /**
     * Returns the timezone.
     * @return string
     */
    public function getTimezone(): string
    {
        return (string)$this->timezone;
    }

    /**
     * Returns an array with data indexed by name.
     * @return array
     */
    public function toArray()
    {
        $administrativeLevels = [];
        foreach ($this->administrativeLevels as $administrativeLevel) {
            $administrativeLevels[$administrativeLevel->getLevel()] = [
                'name'  => $administrativeLevel->getName(),
                'code'  => $administrativeLevel->getCode()
            ];
        }

        return array(
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'bounds' => $this->bounds->toArray(),
            'streetNumber' => $this->streetNumber,
            'streetName' => $this->streetName,
            'postalCode' => $this->postalCode,
            'locality' => $this->locality,
            'subLocality' => $this->subLocality,
            'adminLevels' => $administrativeLevels,
            'country' => $this->country->getName(),
            'countryCode' => $this->country->getCode(),
            'timezone' => $this->timezone,
        );
    }
}
