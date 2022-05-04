<?php

namespace App\Repository\Contract;

use App\Entity\Bottom;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method Bottom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bottom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bottom[]    findAll()
 * @method Bottom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface BottomRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Bottom $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Bottom $entity, bool $flush = true): void;
}