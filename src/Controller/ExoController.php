<?php

namespace App\Controller;

use App\Service\CalculatorService;
use phpDocumentor\Reflection\Types\Integer;
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
}
