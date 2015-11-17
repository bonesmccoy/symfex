<?php

namespace Bones\IntlBundle\Model\Money;

/**
 * Currency
 */
class Currency
{
    const FORMAT_PLACEHOLDER = "%";
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $symbol;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $format;

    /** @var  string */
    private $decimalPoint;

    /** @var  string */
    private $thousandsDivider;


    /**
     * @param $code
     * @param $name
     * @param $symbol
     * @param $format
     * @param $decimalPoint
     * @param $thousandsDivider
     */
    public function __construct($code, $name, $symbol,  $format, $decimalPoint, $thousandsDivider)
    {

        $this->code = $code;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->format = $format;
        $this->decimalPoint = $decimalPoint;
        $this->thousandsDivider = $thousandsDivider;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * Set symbol
     *
     * @param string $symbol
     *
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Currency
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

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Currency
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getDecimalPoint()
    {
        return $this->decimalPoint;
    }

    /**
     * @param string $decimalPoint
     */
    public function setDecimalPoint($decimalPoint)
    {
        $this->decimalPoint = $decimalPoint;
    }

    /**
     * @return string
     */
    public function getThousandsDivider()
    {
        return $this->thousandsDivider;
    }

    /**
     * @param string $thousandsDivider
     */
    public function setThousandsDivider($thousandsDivider)
    {
        $this->thousandsDivider = $thousandsDivider;
    }


}

