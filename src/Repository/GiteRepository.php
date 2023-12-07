<?php

namespace App\Repository;

use App\Entity\Gite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Gite>
 *
 * @method Gite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gite[]    findAll()
 * @method Gite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gite::class);
    }

    public function findDistinctLocations(): array
{
    return $this->createQueryBuilder('g')
        ->select('DISTINCT g.location')
        ->orderBy('g.location', 'ASC')
        ->getQuery()
        ->getResult();
}

    public function findDistinctRegions()
    {
        return $this->createQueryBuilder('g')
            ->select('g.region')
            ->distinct(true)
            ->orderBy('g.region', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findDistinctDepartments()
    {
        return $this->createQueryBuilder('g')
            ->select('g.department')
            ->distinct(true)
            ->orderBy('g.department', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findDistinctCities()
    {
        return $this->createQueryBuilder('g')
            ->select('g.city')
            ->distinct(true)
            ->orderBy('g.city', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findBySearchCriteria(array $criteria)
    {
        
        $queryBuilder = $this->createQueryBuilder('g');
       

        if (!empty($criteria['city'])) {
            $queryBuilder->andWhere('g.city = :city')
                ->setParameter('city', $criteria['city']);
        }
        if (!empty($criteria['region'])) {
            $queryBuilder->andWhere('g.region = :region')
                ->setParameter('region', $criteria['region']);
        }
        if (!empty($criteria['department'])) {
            $queryBuilder->andWhere('g.department = :department')
                ->setParameter('department', $criteria['department']);
        }
        if (!empty($criteria['services'])) {
            
            $serviceRepository = $this->getEntityManager()->getRepository(\App\Entity\Service::class);
            // Convert service names to IDs
            // $serviceNames = $criteria['services'];
            // $serviceIds = $serviceRepository->findIdsByNames($serviceNames);
            $serviceIds = $serviceRepository->findIdsByNames($criteria['services']);

            $queryBuilder->leftJoin('g.services', 'serv')
                ->andWhere('serv.id IN (:servicesIds)')
                ->setParameter('servicesIds', $serviceIds);
        }
    
         if (!empty($criteria['equipment'])) {
            
            // Extract the IDs from the ArrayCollection of Equipment objects
            $equipmentIds = array_map(function ($equipment) {
                return $equipment->getId(); // Assuming the Equipment entity has a getId() method
            }, $criteria['equipment']->toArray());

                        $queryBuilder->leftJoin('g.equipment', 'equip')
                            ->andWhere('equip.id IN (:equipmentIds)')
                            ->setParameter('equipmentIds', $equipmentIds);
                    }
              
        
                    
    return $queryBuilder->getQuery()->getResult();
        
    }

}

//    /**
//     * @return Gite[] Returns an array of Gite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gite
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

