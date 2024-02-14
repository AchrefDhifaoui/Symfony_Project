<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig',[
            'name' => 'achref',
            'firstName' => 'dhifaoui'
        ]);
    }

    #[Route('/hello/{name}/{prenom}', name: 'helloPage')]
    public function hello($name,$prenom): Response
    {

        return $this->render('first/hello.html.twig',[
            'nom' => $name,
            'prenom' => $prenom
        ]);
    }
}
