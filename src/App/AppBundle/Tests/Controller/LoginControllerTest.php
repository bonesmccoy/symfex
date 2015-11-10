<?php

namespace App\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testProcess()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/process');
    }

}
