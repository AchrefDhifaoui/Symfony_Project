<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine):Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personnes =$repository->findAll();
        return $this->render('personne/index.html.twig',['personnes'=>$personnes]);
    }
    #[Route('/add', name: 'personne_add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager() ;

        //$personne2 = new Personne();
        //$personne2->setFirstname('riadh');
        //$personne2->setName('dhifaoui');
        //$personne2->setAge(33);
        //$personne->setJob('developper');
        //ajouter operation insertion personne en bd
        //$entityManager->persist($personne);
        //$entityManager->persist($personne2);
        //exucute la transaction todo
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            //'personne' => $personne,
        ]);
    }
}
