<?php

namespace ForumBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ForumControllerTest extends WebTestCase
{
    public function testCreation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Creation');
    }

}
