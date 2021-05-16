<?php

namespace App\Controller;
use App\Entity\City;
use App\Entity\Land;
use App\Repository\CityRepository;
use App\Repository\LandRepository;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MyAPIController extends AbstractController
{
    //GET ALL CITIES
    /**
     * @Route("/myapi/cities", name="myapi_cities", methods={"GET"})
     */
    public function cities(CityRepository $cityRepository)
    {
        $cities = $cityRepository->findAll();
        return $this->json( $cities, $status = 200, $headers = [], $context = [] );
    }

    //GET ONE CITY
    /**
     * @Route("/myapi/city/{id}", name="myapi_city", methods={"GET"})
     */
    public function city(City $city)
    {
        return $this->json( $city, $status = 200, $headers = [], $context = [] );
    }

    //GET LANDEN
    /**
     * @Route("/myapi/landen", name="myapi_landen", methods={"GET"})
     */
    public function landen(LandRepository $landRepository)
    {
        $landen = $landRepository->findAll();
        return $this->json( $landen, $status = 200, $headers = [], $context = [] );
    }

    //POST NEW LAND
    /**
     * @Route("/myapi/landen", name="myapi_landen_post", methods={"POST"})
     */
    public function landen_new(Request $request, EntityManagerInterface $em)
    {
        $land = new Land();
        $land->setName( $request->request->get("name"));

        $em->persist($land);
        $em->flush();

        return $this->json( $land, $status = 201, $headers = [], $context = [] );
    }

    //GET LAND WITH CUSTOM ADDED INFO
    /**
     * @Route("/myapi/land/{id}", name="myapi_land", methods={"GET"})
     */
    public function land(Land $land)
    {
        $response = [
            "id" => $land->getId(),
            "name" => $land->getName()
            ];

        if ( $land->getId() == 4 )
        {
            $response["extra_info"] = [
                "It rains a lot",
                "Also called The United Kingdom",
                "No longer a member of the EU"
            ];
        }

        return $this->json( $response, $status = 200, $headers = [], $context = [] );
    }

    //REVERSE SOME STRING
    /**
     * @Route("/myapi/reverse/{somestring}", name="myapi_reverse", methods={"GET"})
     */
    public function reverse($somestring)
    {
        $response = [
            "string" => $somestring,
            "reversed" => strrev($somestring)
        ];

        return $this->json( $response, $status = 200, $headers = [], $context = [] );
    }
}