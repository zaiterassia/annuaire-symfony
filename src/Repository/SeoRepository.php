<?php

namespace App\Repository;

use App\Entity\Seo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seo>
 *
 * @method Seo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seo[]    findAll()
 * @method Seo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seo::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Seo $entity, bool $flush = false): void
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
    public function remove(Seo $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

   /**
    * @return int Returns count of Seo objects
    */
   public function findAllCount(): int
   {
       return $this->createQueryBuilder('a')
           -> select('count(a.id)')
           ->getQuery()
           ->getSingleScalarResult();
       ;
   }

      /**
    * @return int Returns count of Seo objects
    */
    public function findCountByResponse(String $response): int
    {
        return $this->createQueryBuilder('a')
            -> select('count(a.id)')
            ->andWhere('a.response = :val')
            ->setParameter('val', $response)
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    /**
    * @return int Returns count of updated objects
    */
    public function findCountApdated(): int
    {
        return $this->createQueryBuilder('a')
            -> select('count(a.id)')
            ->andWhere("a.editDate >= DATE_SUB(CURRENT_DATE(),15, 'day')")
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }


//    /**
//     * @return Seo[] Returns an array of Seo objects
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

//    public function findOneBySomeField($value): ?Seo
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
