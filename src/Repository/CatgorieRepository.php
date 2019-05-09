<?php

namespace App\Repository;

use App\Entity\Catgorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Catgorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catgorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catgorie[]    findAll()
 * @method Catgorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatgorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Catgorie::class);
    }

    // /**
    //  * @return Catgorie[] Returns an array of Catgorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Catgorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
