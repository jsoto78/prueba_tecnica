<?php

namespace App\Tests;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrudWebTest extends WebTestCase
{
    use Helpers\TestHelpers;
    /** @test */
    public function render_login_screen(): void
    {
        // comprbamos el render correcto del login
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Sign in');
    }
    /** @test */
    public function render_register_screen(): void
    {
        //Comprobamos el render correcto del registro
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Register');
    }
    /** @test */
    public function render_home_screen_table(): void
    {
        //Comprobamos el render correcto del home screen y lista de paises
        $client = static::createClient();
        $testUser = $this->getTestUser('ROLE_USER');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/countries');
        $this->assertResponseIsSuccessful();
        $html = $client->getResponse()->getContent();
        $c = new Crawler($html);
        $this->assertEquals(1, $c->filter('table#tablaPaises')->count());

    }
    /** @test */
    public function render_users_screen_table(): void
    {
        // comprobamos el render correcto de la tabla usuarios y el permiso del administrador
        $client = static::createClient();
        $testUser = $this->getTestUser('ROLE_ADMIN');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/user');
        $this->assertResponseIsSuccessful();
        $html = $client->getResponse()->getContent();
        $c = new Crawler($html);
        $this->assertEquals(1, $c->filter('table#tablaUsers')->count());

    }
    /** @test */
    public function users_screen_fobbiden(): void
    {
        //comprobamos que el usuario no posee permisos para acceder a crear o modificar usuarios
        $client = static::createClient();
        $testUser = $this->getTestUser('ROLE_USER');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/user');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());

    }
    
    /** @test */
    public function create_country_in_database(): void
    {
        //Comprobamos la creacion y la eliminacion de los paises en la base de datos

        $CountryRepository = static::getContainer()->get(CountryRepository::class);
        $c = $CountryRepository->findOneByName("Test");
        if($c){
            $CountryRepository->remove($c,true);
        }
        $NewCountry = new Country();
        $NewCountry->setName("Test");
        $NewCountry->setFullName("Test Country");
        $NewCountry->setCode("TC");
        $NewCountry->setCurrency("Test Money");
        $NewCountry->setLanguage("Test Lang");
        $NewCountry->setCapitalCity("Test Capital");
        $NewCountry->setFlag("🇦🇷");
        $NewCountry->setMap("https://www.openstreetmap.org/relation/286393");
        $NewCountry->setPopulation(5);
        $NewCountry->setArea(15);
        $NewCountry->setRegion("Europe");
        $NewCountry->setSubRegion("Southern Europe");
        $CountryRepository->add($NewCountry,true);
        $country = $CountryRepository->findOneByName("Test");
        $this->assertEquals("Test",$country->getName());

    }

    
}
