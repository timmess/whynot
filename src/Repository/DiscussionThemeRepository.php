<?php

namespace App\Repository;

use App\Entity\DiscussionTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscussionTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscussionTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscussionTheme[]    findAll()
 * @method DiscussionTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscussionThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscussionTheme::class);
    }

    // /**
    //  * @return DiscussionTheme[] Returns an array of DiscussionTheme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DiscussionTheme
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
