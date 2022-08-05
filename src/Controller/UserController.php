<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    private $encrypt;

    public function __construct (UserPasswordHasherInterface $encrypt ) 
    {
        $this->encrypt = $encrypt;

    }

    #[Route('/user', name: 'app_users')]
    public function index(Request  $request,ManagerRegistry $mr): Response
    {
        $users = $mr->getRepository(User::class)->findAll();

        $usr = new User();
        $form = $this->createForm(UserType::class,$usr);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $mr->getManager();
            $em->persist($country);
            $em->flush();
            $session = $request->getSession();
            $session->getFlashBag()->add('success',User::CREATED_SUCCESS);
            return $this->redirectToRoute("app_users");
        }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'CountriesController',
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/{Id}', name: 'app_user')]
    public function getUserbyId(string $Id,Request $request,ManagerRegistry $mr): Response
    {

        $user = $mr->getRepository(User::class)->find($Id);
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encrypt->hashPassword($user, $form['password']->getData()));
            $em = $mr->getManager();
            $em->persist($user);
            $em->flush();
            $session = $request->getSession();
            $session->getFlashBag()->add('success',User::UPDATED_SUCCESS);
            return $this->redirectToRoute("app_users");
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
 