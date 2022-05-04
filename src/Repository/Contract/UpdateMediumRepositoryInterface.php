<?php

namespace App\Repository\Contract;


use App\Entity\UpdateMedium;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method UpdateMedium|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateMedium|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateMedium[]    findAll()
 * @method UpdateMedium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface UpdateMediumRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UpdateMedium $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(UpdateMedium $entity, bool $flush = true): void;
}