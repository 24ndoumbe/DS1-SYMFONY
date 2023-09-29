<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProjectionController extends AbstractController
{
    #[Route('/projection', name: 'app_projection')]
    public function index(ProjectionRepository $ProjectionRepository): Response
    {
        $projection = $ProjectionRepository->findAll();
        return $this->render('projection/index.html.twig', [
            'controller_name' => 'ProjectionController',
            'titre' => "Welcome on my page",
            'projection'=>$projection,
            
        ]);
    }

    public function add(Request $request, EntityManagerInterface $em): Response
    {
        #[Route('/ajout', name: 'app_ajout')]
    
        $projection = new Projections();
        $projection = setDateCreation(new \DateTime()); //pour la date


        $form = $this->createForm(FilmType::class , $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projection = $form->getData();
            //on sauvegarde en bdd
            $em->persist($projection);
            $em->flush();
            
            return $this->redirectToRoute('app_film');

        }
}
}
