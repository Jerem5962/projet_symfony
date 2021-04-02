<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Service\CalculatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoController extends AbstractController
{
    /**
     * @Route("/exo/exo1/{num}", name="exo", methods="GET")
     */
    public function index($num, HttpFoundationRequest $req, CalculatorService $calculator): Response
    {
        $method = $req->getMethod();
        $numInt = intval($num);

        if(gettype($numInt) == "integer"){
           $result = $calculator->square($num);

            return $this->render('exo/index.html.twig', [
                'result' => $result,
                'num' => $num,
                'methode' => $method
            ]);
        }
    }

    /**
     * @Route("/exo/exo2", name="exo2", methods={"GET", "POST"})
     */
    public function createCity(HttpFoundationRequest $req, EntityManagerInterface $manager)
    {
        $repo = $manager->getRepository(Country::class);
        $countries = $repo->findAll();

        if($req->getMethod() === "POST"){
            $name = $req->request->get("name");
            $major = $req->request->get("major");
            $country = $req->request->get("country");
            $country = $repo->findOneBy(["name" => $country]);
            //dd($country);

            $city = new City();
            $city
                ->setName($name)
                ->setMajor($major)
                ->setCountry($country);

            $manager->persist($city);
            $manager->flush();

            return $this->redirectToRoute("test3");
        }

        return $this->render("test/_form_addCity.html.twig", [
            "countries" => $countries
        ]);
    }

    /**
     * @Route("/exo/exo2/update/{id}", name="modifCity", methods={"GET", "POST"})
     */
    public function modifCity(
        $id, 
        HttpFoundationRequest $req,
        EntityManagerInterface $manager, 
        CityRepository $repo,
        CountryRepository $repoCountry
        )
    {
        $countries = $repoCountry->findAll();
        $city = $repo->find($id);

        if($req->getMethod() === "POST"){
            $name = $req->request->get("name");
            $major = $req->request->get("major");
            $country = $req->request->get("country");

            $country = $repoCountry->findOneBy(["name" => $country]);

            $city
                ->setName($name)
                ->setMajor($major)
                ->setCountry($country);

            $manager->persist($city);
            $manager->flush();
            
            return $this->redirectToRoute("test3");
        }

        return $this->render("test/_form_addCity.html.twig", [
            "city" => $city,
            "countries" => $countries
        ]);
    }

    
    /**
     * @Route("/exo/exo2/delete/{id}", name="deleteCity", methods={"GET", "POST"})
     */
    public function deleteCity(
        $id,
        EntityManagerInterface $manager, 
        CityRepository $repo
        )
    {

        return $this->redirectToRoute("test6");
    }
}
