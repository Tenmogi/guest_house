<?php

namespace App\Controller;
use App\Form\GiteSearchType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GiteRepository;
use App\Repository\ServiceRepository;


class SearchController extends AbstractController
{

    #[Route('/search', name: 'app_search')]
    public function index(Request $request, GiteRepository $giteRepository, ServiceRepository $serviceRepository): Response
    {
        // Retrieve distinct cities, regions, departments, and features
        $cities = $giteRepository->findDistinctCities();
        $regions = $giteRepository->findDistinctRegions();
        $departments = $giteRepository->findDistinctDepartments();
        // $distinctServiceNames = $serviceRepository->findDistinctServiceNames();

        // Create the search form
        $form = $this->createForm(GiteSearchType::class, null, [
        'cities' => $cities,
        'regions' => $regions,
        'departments' => $departments,
        //  'services' => $distinctServiceNames, // Pass the distinct service names to the form
        ]);

        $form->handleRequest($request);

        // Initialize an empty array to hold the search results
        $gites = [];

        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
            dump($criteria);
            // Get the data from the form
           // Use the findBySearchCriteria method from the GiteRepository to search for Gites
            $gites = $giteRepository->findBySearchCriteria($criteria);
         
        }
        

        // Render the search results in the Twig template
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'gites' => $gites,
        ]);
    }
}