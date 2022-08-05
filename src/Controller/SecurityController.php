<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserRegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_countries');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    #[Route('/register', name: 'app_register')]
    public function index( Request  $request,ManagerRegistry $mr ,
     UserPasswordHasherInterface $encrypt ): Response
    {
        $user = new User();
        $form = $this->createForm(UserRegisterType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($encrypt->hashPassword($user, $form['password']->getData()));
            $em = $mr->getManager();
            $em->persist($user);
            $em->flush();
            $session = $request->getSession();
            $session->getFlashBag()->add('success',User::REGISTER_SUCCESS);
            return $this->redirectToRoute("app_login");
        }
 
        return $this->render('security/register.html.twig', [
            'form'=> $form->createView(),
        ]);
    } 
    #[Route('/', name: 'app_default')]
    public function index_default(): Response
    {
        return $this->redirectToRoute('app_login');

    }
}
