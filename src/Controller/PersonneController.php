<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Service\helpers;
use App\Service\MailerService;
use App\Service\pdfService;
use App\Service\UploaderService;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
#[Route('personne')]
class PersonneController extends AbstractController
{

    public function __construct(private LoggerInterface $logger , private Helpers $helper)
    {
    }

    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine):Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personnes =$repository->findAll();
        return $this->render('personne/index.html.twig',['personnes'=>$personnes]);
    }
    #[Route('/pdf/{id}', name: 'personne.pdf')]
    public function generatePdfPersonne(Personne $personne=null , pdfService $pdf): void
    {
        $html =$this->render('personne/detail.html.twig',['personne'=>$personne]);
        $pdf->showPdfFile($html);
    }
    #[Route('/alls/age/{ageMin}/{ageMax}', name: 'personne.list.age')]
    public function personneByAge(ManagerRegistry $doctrine ,$ageMin ,$ageMax):Response
    {

        $repository = $doctrine->getRepository(Personne::class);
        $personnes =$repository->findPersonneByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/index.html.twig',['personnes'=>$personnes]);
    }
    #[Route('/stats/age/{ageMin}/{ageMax}', name: 'personne.list.age.stats')]
    public function statsPersonnesByAge(ManagerRegistry $doctrine ,$ageMin ,$ageMax):Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $stats =$repository->statsPersonneByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/stats.html.twig',['stats'=>$stats[0] ,'ageMin' =>$ageMin ,'ageMax'=>$ageMax]);
    }
    #[Route('/alls/{page?1}/{nmbre?12}', name: 'personne.list.alls')]
    public function indexAlls(ManagerRegistry $doctrine ,$page ,$nmbre):Response
    {
        //echo ($this->helper->sayCc());
        $repository = $doctrine->getRepository(Personne::class);
        $nbPersonne = $repository->count([]);
        $nbrePage =  ceil($nbPersonne / $nmbre) ;
        $personnes =$repository->findBy([],[],$nmbre,($page -1)*$nmbre);

        return $this->render('personne/index.html.twig',['personnes'=>$personnes ,'isPaginated'=>true , 'nbrePage'=>$nbrePage , 'page'=>$page ,'nbre'=>$nmbre]);
    }
    #[Route('/{id<\d+>}', name: 'personne.detail')]
    public function detail(Personne $personne = null):Response
    {

        if (!$personne){
            $this->addFlash('error',"la personne avec id personne nexiste pas");
            return $this->redirectToRoute('personne.list');
        }

        return $this->render('personne/detail.html.twig',['personne'=>$personne]);
    }
    #[Route('/add', name: 'personne_add')]
    public function addPersonne(ManagerRegistry $doctrine , Request $request , UploaderService $uploaderService ,MailerService $mailer): Response
    {

        $personne = new Personne();


        $form =$this->createForm(PersonneType::class,$personne);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $doctrine->getManager() ;
            $entityManager->persist($personne);
            $photo = $form->get('photo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $directory = $this->getParameter('personne_directory');


                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $personne->setImage($uploaderService->uploadFile($photo,$directory));
            }
            $entityManager->flush();
            $mailMessage = $personne->getFirstname().' '.$personne->getName().'est ajouter';
            $mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('personne.list');
        }else{
            return $this->render('personne/add-personne.html.twig', [
                'form'=>$form->createView()
            ]);
        }

    }
    #[Route('/delete/{id}', name: 'personne.delete')]
    public function deletePersonne(Personne $personne =null , ManagerRegistry $doctrine):RedirectResponse
    {
        //recupere la personne
        if ($personne){
            $manager = $doctrine->getManager();
            //removing
            $manager->remove($personne);
            //execution
            // //si la personne existe  => en va le suppprimer et retournezr un flash success
            $manager->flush();
            $this->addFlash('success',"la personne a ete supprime avec success");
        }else{
            //sinon retourner flash error
            $this->addFlash('error',"la personne existe pas");
        }
        return $this->redirectToRoute('personne.list.alls');


    }
    #[Route('/update/{id}/{name}/{firstname}/{age}', name: 'personne.update')]
    public function updatePersonne(Personne $personne = null ,ManagerRegistry $doctrine,$name , $firstname ,$age):RedirectResponse
    {
        //verifier existance de personne
        if ($personne){
            //si existe => update personne , flush success
            $this->addFlash('success',"la personne a ete modofier avec success");
            $personne->setName($name);
            $personne->setFirstname($firstname);
            $personne->setAge($age);
            $manager = $doctrine->getManager();
            $manager->persist($personne);
            $manager->flush();
        }else{
            //si non => flush error
            $this->addFlash('error',"la personne existe pas");
        }
        return $this->redirectToRoute('personne.list.alls');


    }
}
