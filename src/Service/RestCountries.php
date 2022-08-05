<?php

namespace App\Service;

use Unirest; 
use App\Entity\Country;
use Unirest\Request\Body;
use Doctrine\Persistence\ManagerRegistry;

class RestCountries
{

    public  $host = null;
    private  $headers = null;

    public function __construct(){
        $this->host = "https://restcountries.com/v3.1/";
        $this->headers = array('Accept' => 'application/json');
    }
    
    public function getAllConutries(){

        $url = "{$this->host}/all";
        $response = Unirest\Request::get($url,$this->headers);
        return $response->body;

    }
    public function getConutrybyName($name,ManagerRegistry $mr){
        $name = str_replace(" ","%20",$name);
        $url = "{$this->host}/name/{$name}";
        $response = Unirest\Request::get($url,$this->headers);
        $country=$response->body;
        if($response->code === 200){
            foreach ($country as $key => $c) {
                if ($this->getCountryFromDb($c->name->common,$mr)){
                    $res["status"] = 400;
                    return $res;
                }
            }
            $country["status"] = 200;
        }
        return $country;

    }

    public function getCountryFromDb(string $name,ManagerRegistry $mr){

        $country =  $mr->getRepository(Country::class)->findBy(['name'=>$name]);
        if(count($country)>0){
            return true;
         
        }
        return false;
    }

}

?>