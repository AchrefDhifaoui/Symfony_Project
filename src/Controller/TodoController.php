<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/todo')]

class TodoController extends AbstractController
{
    #[Route('', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request -> getSession();
        if (!$session->has('todos')){
            $todos = [
                'achat'=>'acheter cle usb',
                'cours'=>'finaliser mon cours',
                'correction'=>'corriger mes examens'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"inialiser avec succes");
        }
        return $this->render('todo/index.html.twig');
    }
    #[Route('/add/{name}/{content}', name: 'todo.add',defaults: ['content' => 'sf6'])]
    public function addTodo(Request $request , $name , $content ):RedirectResponse{
        $session = $request->getSession();
        //verifier si j'ai mon tableau todo en session
        if ($session->has('todos')){
            $todos  =  $session->get('todos');
            if (isset($todos[$name])){
                $this->addFlash('error',"le todo existez deja dans la liste");

            }else{
                $todos[$name] = $content ;
                $this->addFlash('success',"ajouter avec sucees");
                $session->set('todos',$todos);

            }

        }else{
            $this->addFlash('error',"liste non initialisee");


        }



        return $this->redirectToRoute('app_todo');
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request , $name , $content ):RedirectResponse{
        $session = $request->getSession();
        //verifier si j'ai mon tableau todo en session
        if ($session->has('todos')){
            $todos  =  $session->get('todos');
            if (!isset($todos[$name])){
                $this->addFlash('error',"le todo existez pas dans la liste");

            }else{
                $todos[$name] = $content ;
                $this->addFlash('success',"modofier avec sucees");
                $session->set('todos',$todos);

            }

        }else{
            $this->addFlash('error',"liste non initialisee");


        }



        return $this->redirectToRoute('app_todo');
    }
    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request , $name  ):RedirectResponse{
        $session = $request->getSession();
        //verifier si j'ai mon tableau todo en session
        if ($session->has('todos')){
            $todos  =  $session->get('todos');
            if (!isset($todos[$name])){
                $this->addFlash('error',"le todo existez pas dans la liste");

            }else{
                unset($todos[$name]);
                $this->addFlash('success',"supprimer avec sucees");
                $session->set('todos',$todos);

            }

        }else{
            $this->addFlash('error',"liste non initialisee");


        }



        return $this->redirectToRoute('app_todo');
    }
    #[Route('/reset', name: 'todo.reset')]

    public function resetTodo(Request $request ):RedirectResponse{
        $session = $request->getSession();
        //verifier si j'ai mon tableau todo en session
        $session->remove('todos');



        return $this->redirectToRoute('app_todo');
    }



}
