<?php

namespace App\Controller;

use App\Entity\ParametreIota;
use App\Form\ParametreIotaType;
use App\Repository\ParametreIotaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parametre')]
class ParametreIotaController extends AbstractController
{
    #[Route('/', name: 'app_parametre_iota_index', methods: ['GET'])]
    public function index(ParametreIotaRepository $parametreIotaRepository): Response
    {
        return $this->render('parametre_iota/index.html.twig', [
            'parametre_iotas' => $parametreIotaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parametre_iota_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parametreIotum = new ParametreIota();
        $form = $this->createForm(ParametreIotaType::class, $parametreIotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parametreIotum);
            $entityManager->flush();

            return $this->redirectToRoute('app_parametre_iota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parametre_iota/new.html.twig', [
            'parametre_iotum' => $parametreIotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parametre_iota_show', methods: ['GET'])]
    public function show(ParametreIota $parametreIotum): Response
    {
        return $this->render('parametre_iota/show.html.twig', [
            'parametre_iotum' => $parametreIotum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parametre_iota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParametreIota $parametreIotum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParametreIotaType::class, $parametreIotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parametre_iota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parametre_iota/edit.html.twig', [
            'parametre_iotum' => $parametreIotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parametre_iota_delete', methods: ['POST'])]
    public function delete(Request $request, ParametreIota $parametreIotum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametreIotum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($parametreIotum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parametre_iota_index', [], Response::HTTP_SEE_OTHER);
    }
}
