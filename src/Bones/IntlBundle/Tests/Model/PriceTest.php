<?php

namespace Bones\IntlBundle\Tests\Model;


use Bones\IntlBundle\Model\Money\Currency;
use Bones\IntlBundle\Model\Money\Price;

class PriceTest  extends \PHPUnit_Framework_TestCase
{


    public function testCorrectFormatting()
    {
        $currency = new Currency('EUR', 'Euro', 'e', Currency::FORMAT_PLACEHOLDER . " e", "," , ".");
        $price = new Price(1000.00, $currency);

        $this->assertEquals("1.000,00 e", $price->format());
        $price = new Price(1000000.00, $currency);
        $this->assertEquals("1.000.000,00 e", $price->format());
        $price = new Price(112345.23, $currency);
        $this->assertEquals("112.345,23 e", $price->format());

        $currency = new Currency('USD', 'Us Dollar', '$', "$ " . Currency::FORMAT_PLACEHOLDER, "." , ",");
        $price = new Price(112345.23, $currency);
        $this->assertEquals("$ 112,345.23", $price->format());
        $price = new Price(112345.23, $currency);
        $this->assertEquals("$ 112,345.23", $price->format());

        $price = new Price(112345.24, $currency);
        $this->assertEquals("$ 112,345.24", $price->format());

        $price = new Price(112345.99, $currency);
        $this->assertEquals("$ 112,345.99", $price->format());
    }
}
