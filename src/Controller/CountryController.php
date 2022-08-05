<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Service\DataBaseHelper;
use Symfony\Component\Intl\Countries;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CountryController extends AbstractController
{



    #[Route('/country/{Id}', name: 'app_country')]
    public function getCountry(Request  $request,ManagerRegistry $mr): Response
    {
        $rp = $request->attributes->get('_route_params');
        $country_id = $rp['Id'];
        $country = $mr->getRepository(Country::class)->find($country_id);
        $form = $this->createForm(CountryType::class,$country);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $db = new DataBaseHelper();
            $db->save($country,$mr);
            return $this->redirectToRoute("app_countries");
        }
        return $this->render('country/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/countries', name: 'app_countries')]
    public function index(Request  $request,ManagerRegistry $mr): Response
    {
        $countries = $mr->getRepository(Country::class)->findAll();
        $country = new Country();
        $form = $this->createForm(CountryType::class,$country);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $db = new DataBaseHelper();
            $db->save($country,$mr);
            $session = $request->getSession();
            $session->getFlashBag()->add('success',Country::CREATED_SUCCESS);
            return $this->redirectToRoute("app_countries");
        }
        return $this->render('country/index.html.twig', [
            'controller_name' => 'CountriesController',
            'countries' => $countries,
            'form' => $form->createView(),
        ]);
    }
}
