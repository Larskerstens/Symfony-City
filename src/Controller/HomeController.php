<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function homepage(CityRepository $cityRepository)
    {
        $cities = $cityRepository->findAll();

        return $this->render('home/home.html.twig', [
                'cities' => $cities
            ]
        );
    }
}