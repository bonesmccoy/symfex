<?php

namespace Bones\IntlBundle\Tests\Model;


use Bones\IntlBundle\Model\Location\State;
use Bones\IntlBundle\Model\Location\StateRepository;

class StateRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function testValidRepository()
    {
        $repository = new StateRepository();

        $states = $repository->findAll();

        $this->assertTrue(count($states) > 1);
        $this->assertTrue(isset($states['US']));

        $colorado = $repository->findOneByCodeAndCountryCode('CO', 'US');
        $this->assertTrue($colorado instanceof State);
        $this->assertEquals('Colorado', $colorado->getName());
        $this->assertEquals('CO', $colorado->getCode());

    }
}
