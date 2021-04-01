<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test1", name="test1", methods={"GET", "POST"})
     */
    public function test1()
    {
        $html = "<html><header></header><body><h1>Coucou !</h1></body></html>";
        $res = new Response();
        $res->setContent($html);

        return $res;
    }

    public function test2()
    {
        $json = [
            "name" => "jerem",
            "age" => 18,
            "is_mute" => true
        ];

        return new JsonResponse($json);
    }

    /**
     * @Route("/test3", name="test3")
     */
    public function test3(Request $req)
    {
        // URL à utiliser /test3/?search=cdnt12
        $searchValue = $req->query->get("search");
        $method = $req->getMethod();
        //dd($searchValue, $method, $req);

        return $this->render("test/test3.html.twig", [
            "title" => "Bonjour",
            "searchValue" => $searchValue,
            "method" => $method,
            "students" => [
                "jerem", "umberto", "noemie", "clementine"
            ]
        ]);
    }

    /**
     * @Route("/test4/student/{id}/delete", name="test4", requirements={"id" = "\d+"})
     */
    public function test4($id)
    {
        return new Response($id);
    }
}
