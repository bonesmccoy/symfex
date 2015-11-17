<?php

namespace Bones\IntlBundle\Model\Location;

/**
 * Country
 */
class Country
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;


    public function __construct($countryCode, $countryName)
    {

        $this->code = $countryCode;
        $this->name = $countryName;
    }

    /**
     * Set code
     *
     * @param string $countryCode
     *
     * @return Country
     */
    public function setCode($countryCode)
    {
        $this->code = $countryCode;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

