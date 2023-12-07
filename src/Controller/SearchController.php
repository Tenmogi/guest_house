<?php

namespace App\Controller;
use App\Form\GiteSearchType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GiteRepository;
use App\Repository\ServiceRepository;
use App\Repository\EquipmentRepository;


class SearchController extends AbstractController
{

    #[Route('/search', name: 'app_search')]
    public function index(Request $request, GiteRepository $giteRepository, ServiceRepository $serviceRepository, EquipmentRepository $equipmentRepository): Response
    {
        // Retrieve distinct cities, regions, departments, and features
        $cities = $giteRepository->findDistinctCities();
        $regions = $giteRepository->findDistinctRegions();
        $departments = $giteRepository->findDistinctDepartments();
         $distinctServiceNames = $serviceRepository->findDistinctServiceNames();
         $distinctEquipment = $equipmentRepository->findAll();

        // Create the search form
        $form = $this->createForm(GiteSearchType::class, null, [
        'cities' => $cities,
        'regions' => $regions,
        'departments' => $departments,
         'services' => $distinctServiceNames,
         'equipment' => $distinctEquipment,
       
        ]);

        $form->handleRequest($request);

        // Initialize an empty array to hold the search results
        $gites = [];

        // Initialize a flag to false
        $includeEquipment = false;

        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
                            
     // Check if equipment was part of the search criteria
     $includeEquipment = !empty($criteria['equipment']);

           // findBySearchCriteria method from the GiteRepository to search for Gites
            $gites = $giteRepository->findBySearchCriteria($criteria);
         
        }
        
        // Render the search results in the Twig template
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'gites' => $gites,
            'includeEquipment' => $includeEquipment, // Pass the flag to the template
        ]);
    }
}