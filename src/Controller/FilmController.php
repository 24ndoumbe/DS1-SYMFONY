<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmRepository;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film')]
    public function index(FilmRepository $FilmRepository): Response
    {
        $films = $FilmRepository->findAll();
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
            'titre' => "Bienvenue sur ma page d'acceuil",
            'films' => $films
        

        ]);
        return $this->redirectToRoute('app_projection');
    }


   
}
