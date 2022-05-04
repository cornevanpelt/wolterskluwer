<?php

namespace App\Repository\Contract;

use App\Entity\Topping;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method Topping|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topping|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topping[]    findAll()
 * @method Topping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface ToppingRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Topping $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Topping $entity, bool $flush = true): void;
}