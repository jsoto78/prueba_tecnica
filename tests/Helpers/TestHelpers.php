<?php

namespace App\Tests\Helpers;

use App\Entity\User;
use App\Entity\Country;
use App\Repository\UserRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;

trait TestHelpers
{
    protected function getTestUser(string $role = 'ROLE_USER'): User
    {
       
        $userRepository = static::getContainer()->get(UserRepository::class);
        switch ($role) {
            case 'ROLE_ADMIN':
                $name = 'Test Admin';
                $email = 'admin@test.com';
                break;
        
            default:
                $name = 'Test User';
                $email = 'user@test.com';
                break;
        }

        $testUser = $userRepository->findOneByEmail($email);  
        if($testUser){ //Si el usuario existe lo retornamos
            return $testUser;
        }
        $usr = new User(); // si no existe lo creamos
        $usr->setName($name);
        $usr->setEmail($email);
        $usr->setPassword('1234');
        $usr->setRoles([$role]);
        $userRepository->add($usr,true);
        return $userRepository->findOneByEmail($email);   
       
    }

}
