<?php

namespace App\Form;

use App\Entity\Equipment;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\GiteRepository;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class GiteSearchType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $cities = [];
        foreach ($options['cities'] as $city) {
            $cities[$city['city']] = $city['city'];
        }

        $regions = [];
        foreach ($options['regions'] as $region) {
            $regions[$region['region']] = $region['region'];
        }

        $departments = [];
        foreach ($options['departments'] as $department) {
            $departments[$department['department']] = $department['department'];
        }
          $services = [];
          foreach ($options['services'] as $service) {
             $services[$service['name']] = $service['name'];
          }

        $builder
        ->add('city', ChoiceType::class, [
                'choices' => $cities,
                'required' => false,
                'placeholder' => 'Choose a city',
            ])
            ->add('region', ChoiceType::class, [
                'choices' => $regions,
                'required' => false,
                'placeholder' => 'Choose a region',
            ])
            ->add('department', ChoiceType::class, [
                'choices' => $departments,
                'required' => false,
                'placeholder' => 'Choose a department',
            ])

        ->add('services', ChoiceType::class, [
            'choices' => $services,
            'required' => false,
            'placeholder' => 'Select services',
            'multiple' => true,
            'expanded' => true,
            ])

            ->add('equipment', EntityType::class, [
                'class' => Equipment::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true, // To render as checkboxes
                'required' => false,
                'placeholder' => 'Select equipment', 
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
            ]);
            }
 
                

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                 'cities' => [],
             'regions' => [],
             'departments' => [],
              'services' => [], 
             'equipment' => [],
               // 'data_class' => Gite::class,
            ]);
        }
    }




    
