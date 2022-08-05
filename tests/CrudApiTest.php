<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrudApiTest extends WebTestCase
{ 

   use Helpers\TestHelpers;
      /** @test */
      public function api_retrive_all_countries(): void
      {
          //comprobamos que al api responda los 250 paises
          $client = static::createClient();
          $testUser = $this->getTestUser('ROLE_USER');
          $client->loginUser($testUser);
          $crawler = $client->request('GET', '/api/get_all_country');
          $this->assertResponseIsSuccessful();
          $json = json_decode($client->getResponse()->getContent());
          $this->assertEquals(250, count($json));
     }
      /** @test */
      public function api_retrive_one_country(): void
      {
          //comprobamos que al api responda a la busqueda de spain
          $client = static::createClient();
          $testUser = $this->getTestUser('ROLE_USER');
          $client->loginUser($testUser);
          $response = $client->request('GET', '/api/country_by_name/spain');
          $this->assertResponseIsSuccessful();
          $json = json_decode($client->getResponse()->getContent(), true)[0];
          $this->assertEquals($json['name']['common'], "Spain");
      }
      
}
