<?php

namespace App\Controller;

use App\Entity\FormationAssuree;
use App\Form\FormationAssureeType;
use App\Repository\FormationAssureeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/formation/assuree')]
class FormationAssureeController extends AbstractController
{
    #[Route('/', name: 'app_formation_assuree_index', methods: ['GET'])]
    public function index(FormationAssureeRepository $formationAssureeRepository): Response
    {
        return $this->render('formation_assuree/index.html.twig', [
            'formation_assurees' => $formationAssureeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formation_assuree_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formationAssuree = new FormationAssuree();
        $form = $this->createForm(FormationAssureeType::class, $formationAssuree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formationAssuree);
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_assuree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formation_assuree/new.html.twig', [
            'formation_assuree' => $formationAssuree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_assuree_show', methods: ['GET'])]
    public function show(FormationAssuree $formationAssuree): Response
    {
        return $this->render('formation_assuree/show.html.twig', [
            'formation_assuree' => $formationAssuree,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_assuree_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormationAssuree $formationAssuree, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationAssureeType::class, $formationAssuree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_assuree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formation_assuree/edit.html.twig', [
            'formation_assuree' => $formationAssuree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_assuree_delete', methods: ['POST'])]
    public function delete(Request $request, FormationAssuree $formationAssuree, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationAssuree->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formationAssuree);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formation_assuree_index', [], Response::HTTP_SEE_OTHER);
    }
}
