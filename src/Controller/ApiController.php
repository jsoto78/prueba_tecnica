<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Countries;
use App\Service\RestCountries;
use App\Service\DataBaseHelper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{

    #[Route('/api/country_by_name/{name}', name: 'app_api_country-name',methods: ['GET'])]
    public function getCountry(string $name,Request  $request,ManagerRegistry $mr): Response
    {

        $api = new RestCountries();
        $country = $api->getConutrybyName($name,$mr); // busco el pais en la api y en db.
       
        return $this->json(
            $country,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );

    }
    #[Route('/api/get_all_country', name: 'app_api_all_country',methods: ['GET'])]
    public function getAllCountry(Request  $requestr): Response
    {
        $api = new RestCountries();
        $countries = $api->getAllConutries(); // traemos todos los paises para llenar el option list
        return $this->json(
            $countries,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }
    #[Route('/api/delete_by_id/{id}', name: 'app_api_country_delete',methods: ['DELETE'])]
    public function deleteCountry(int $id,Request  $request,ManagerRegistry $mr): Response
    {
        /* Elimino un pais */
        $db = new DataBaseHelper();
        $db->delete_byId($id,Country::class,$mr);
        return $this->json(
            ['status'=>'deleted'],
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }

}
