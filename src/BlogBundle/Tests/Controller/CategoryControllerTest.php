<?php

namespace BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testAddedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/category/add-edit');
    }

}
