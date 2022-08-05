<?php

namespace App\Service;

use Unirest; 
use App\Entity\Country;
use Unirest\Request\Body;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DataBaseHelper
{



    public function save($entity,ManagerRegistry $mr){
        $em = $mr->getManager();
        $em->persist($entity);
        $em->flush();

    }

    public function delete_byId(int $id,$entity,ManagerRegistry $mr)
    {
        $em = $mr->getManager();
        $country = $mr->getRepository($entity)->find($id);
        $em->remove($country);
        $em->flush();

    }

}

?>