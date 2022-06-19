<?php

namespace App\Repository;

use App\Entity\Vehicule;
use App\Filter\VehiculeFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicule>
 *
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Vehicule $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Vehicule $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return Vehicule[] Returns an array of Vehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicule
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    // public function findVehicules(): ?Vehicule
    // {
    //     return $this->createQueryBuilder('v')
    //         ->leftJoin("v.image", "i")
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    public function findVehicules(): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->leftJoin("v.image", "i")
            ->andWhere("v.disponible = 1")
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    public function findFiltre(VehiculeFilter $filter)
    {
        $query = $this->createQueryBuilder("v")
            ->leftJoin("v.categorie", "c")
            ->andWhere("v.disponible = 1")
            // ->leftJoin("v.marque", "mq")
            // ->leftJoin("v.model", "mdl")
            ->leftJoin("v.couleurs", "clr");

        if ($filter->recherche)
        {
            $query = $query
            ->andWhere("v.titre LIKE :recherche")
            ->orWhere("v.description LIKE :recherche")
            ->orWhere("v.prix LIKE :recherche")
            ->orWhere("c.nom LIKE :recherche")
            ->orWhere("dlt.nom LIKE :recherche")
            ->orWhere("mq.nom LIKE :recherche")
            ->orWhere("clr.nom LIKE :recherche")
            ->setParameter("recherche", "%$filter->recherche%");
        }
        if ($filter->categorie)
        {
            $query = $query
            ->andWhere("c.id IN(:cat)")
            ->setParameter("cat", $filter->categorie)
            ;
            
        }
        if ($filter->marque)
        {
            $query = $query
            ->andWhere("mq.id IN(:mq)")
            ->setParameter("mq", $filter->marque)
            ;
        }
        if ($filter->model)
        {
            $query = $query
            ->andWhere("mdl.id IN(:mdl)")
            ->setParameter("mdl", $filter->model)
            ;
        }
        if ($filter->couleur)
        {
            $query = $query
            ->andWhere("clr.id IN(:clr)")
            ->setParameter("clr", $filter->couleur)
            ;
        }
        if ($filter->min)
        {
            $query = $query
            ->andWhere("p.prix >= :min")
            ->setParameter("min", $filter->min)
            ;
        }
        if ($filter->max)
        {
            $query = $query
            ->andWhere("p.prix <= :max")
            ->setParameter("max", $filter->max)
            ;
        }



        return $query->getQuery()->getResult();
    }

}
