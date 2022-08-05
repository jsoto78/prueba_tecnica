<?php

namespace App\Service;

use Unirest; 
use App\Entity\Country;
use Unirest\Request\Body;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DataBaseHelper
{



    public function save($entity,ManagerRegistry $mr,SessionInterface $session){
        $em = $mr->getManager();
        $em->persist($entity);
        $em->flush();
        $session->getFlashBag()->add('success',Country::CREATED_SUCCESS);
    }

   

}

?>