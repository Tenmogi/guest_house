<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GiteRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    
    #[Route('/browse-gites', name: 'app_gites')]
    public function browseGites(GiteRepository $giteRepository): Response
    {
        $gites = $giteRepository->findAll(); // Fetch all Gites from the database

        return $this->render('gites/browse.html.twig', [
            'gites' => $gites,
        ]);
    }
}

