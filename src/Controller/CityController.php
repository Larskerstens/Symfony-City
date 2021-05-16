<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\LandRepository;
use App\Service\SelectBoxService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city/{id}", name="city_detail", methods={"GET"})
     */
    public function detail(City $city, SelectBoxService $sbs, LandRepository $landRepository)
    {
        //generate select box for land
        if ( $city->getLand() ) $lan_id = $city->getLand()->getId();
        else $lan_id = 0;

        $options = $landRepository->findAll();
        $landSelectBox = $sbs->generate("land", $lan_id, $options );

        //merge template with data
        return $this->render('city/detail.html.twig', [
                'city' => $city,
                'landSelectBox' => $landSelectBox
            ]
        );
    }

    /**
     * @Route("/city/{id}", name="city_save", methods={"POST"})
     */
    public function save(City $city,
                                        Request $request,
                                        EntityManagerInterface $em,
                                        LandRepository $landRepository)
    {
        if ( $request->request->get("btnOpslaan") )
        {
            //update city with submitted data
            $city->setTitle( $request->request->get("title") );
            $city->setWidth( $request->request->get("width") );
            $city->setHeight( $request->request->get("height") );
            $city->setDescription( $request->request->get("description") );
            $city->setImage( $request->request->get("image") );

            //find and set land
            $lan_id = $request->request->get("land");
            if ( $lan_id >= 0 )
            {
                $land =  $landRepository->find( $lan_id );
                $city->setLand( $land );
            }

            //save $city
            $em->flush();
        }

        //back to home
        return $this->redirectToRoute( 'home' );
    }

}