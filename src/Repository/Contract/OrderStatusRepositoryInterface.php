<?php

namespace App\Repository\Contract;


use App\Entity\OrderStatus;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method OrderStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatus[]    findAll()
 * @method OrderStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface OrderStatusRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(OrderStatus $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(OrderStatus $entity, bool $flush = true): void;
}