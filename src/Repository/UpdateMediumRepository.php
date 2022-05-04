<?php

namespace App\Repository;

use App\Entity\UpdateMedium;
use App\Repository\Contract\UpdateMediumRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UpdateMedium|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateMedium|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateMedium[]    findAll()
 * @method UpdateMedium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateMediumRepository extends ServiceEntityRepository implements UpdateMediumRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdateMedium::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UpdateMedium $entity, bool $flush = true): void
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
    public function remove(UpdateMedium $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UpdateMedium[] Returns an array of UpdateMedium objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UpdateMedium
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
