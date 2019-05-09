<?php

namespace App\Repository;

use App\Entity\Subjec;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subjec|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subjec|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subjec[]    findAll()
 * @method Subjec[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjecRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subjec::class);
    }

    // /**
    //  * @return Subjec[] Returns an array of Subjec objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subjec
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
