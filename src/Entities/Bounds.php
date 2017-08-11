<?php
namespace Digbang\Locations\Entities;

class Bounds
{
    /** @var null|float */
    private $south;

    /** @var null|float */
    private $west;

    /** @var null|float */
    private $north;

    /** @var null|float */
    private $east;

    /**
     * @param null|float $south
     * @param null|float $west
     * @param null|float $north
     * @param null|float $east
     */
    public function __construct(
        float $south = null,
        float $west = null,
        float $north = null,
        float $east = null
    ) {
        $this->south = $south;
        $this->west  = $west;
        $this->north = $north;
        $this->east  = $east;
    }

    /**
     * Returns the south bound.
     * @return null|float
     */
    public function getSouth(): ?float
    {
        return $this->south;
    }

    /**
     * Returns the west bound.
     * @return null|float
     */
    public function getWest(): ?float
    {
        return $this->west;
    }

    /**
     * Returns the north bound.
     * @return null|float
     */
    public function getNorth(): ?float
    {
        return $this->north;
    }

    /**
     * Returns the east bound.
     * @return null|float
     */
    public function getEast(): ?float
    {
        return $this->east;
    }

    /**
     * Returns whether or not bounds are defined
     * @return bool
     */
    public function isDefined(): bool
    {
        return !is_null($this->south) && !is_null($this->east) && !is_null($this->north) && !is_null($this->west);
    }

    /**
     * Returns an array with bounds.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'south' => $this->getSouth(),
            'west' => $this->getWest(),
            'north' => $this->getNorth(),
            'east' => $this->getEast(),
        ];
    }
}
