<?php

namespace App\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterbuyer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/account/buyer');
    }

    public function testRegisterseller()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/account/seller');
    }

}
