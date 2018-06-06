<?php
namespace Digbang\Locations\Entities;

class Coordinates implements \JsonSerializable
{
    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Returns the latitude.
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns the longitude.
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function jsonSerialize()
    {
        return [
            'lat' => $this->getLatitude(),
            'lng' => $this->getLongitude(),
        ];
    }
}
