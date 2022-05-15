<?php

namespace App\Repository;

use App\Entity\Annuary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annuary>
 *
 * @method Annuary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annuary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annuary[]    findAll()
 * @method Annuary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnuaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annuary::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Annuary $entity, bool $flush = false): void
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
    public function remove(Annuary $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
    * @return int Returns count of Site objects
    */
    public function findAllCount(): int
    {
        return $this->createQueryBuilder('a')
            -> select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

//    /**
//     * @return Annuary[] Returns an array of Annuary objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Annuary
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
