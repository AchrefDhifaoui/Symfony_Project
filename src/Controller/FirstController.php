<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FirstController extends AbstractController
{
    #[Route('/order/{maVar}', name: 'test.ordre.route')]
    public function TestOrdreRoute($maVar)
    {
        return new Response("<html><body>$maVar</body></html>");
    }

    #[Route('/template', name: 'template')]
    public function template()
    {
        return $this->render('template.html.twig');
    }


    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig',[
            'name' => 'achref',
            'firstName' => 'dhifaoui',
            'path' => 'tim.jpg'
        ]);
    }

    //#[Route('/hello/{name}/{prenom}', name: 'helloPage')]
    public function hello($name,$firstname): Response
    {

        return $this->render('first/hello.html.twig',[
            'name' => $name,
            'firstname' => $firstname,
        ]);
    }
    #[Route('multi/{entier1<\d+>}/{entier2<\d+>}',name: 'multuplication')]
    public function multiplication($entier1 , $entier2)
    {
        $resultat = $entier1 * $entier2 ;
        return new Response("<h1>$resultat</h1>");

    }
}
