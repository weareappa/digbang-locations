<?php
namespace Digbang\Locations\Entities;

use Digbang\Locations\Util\Identity;

class Country
{
    use Identity;

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    /**
     * @param string $name
     * @param string $code
     */
    public function __construct(string $name, string $code)
    {
        $this->name = $name;
        $this->code = $code;

        $this->initializeId();
    }

    /**
     * Returns the country name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the country ISO code.
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Returns a string with the country name.
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
