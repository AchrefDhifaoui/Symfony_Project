<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function mysql_xdevapi\getSession;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $session = $request->getSession();
        if ($session->has('nbVisite')){
            $nmbrVisite = $session->get('nbVisite')+1;

        }else{
            $nmbrVisite = 1;

        }
        $session->set('nbVisite',$nmbrVisite);
        return $this->render('session/index.html.twig');
    }
}
