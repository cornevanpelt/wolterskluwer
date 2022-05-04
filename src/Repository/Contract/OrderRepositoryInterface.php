<?php

namespace App\Repository\Contract;

use App\Entity\Order;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface OrderRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Order $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Order $entity, bool $flush = true): void;
}