<?php

namespace App\Repository;

use App\Entity\HashGenerates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HashGenerates|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashGenerates|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashGenerates[]    findAll()
 * @method HashGenerates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashGenaratesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HashGenerates::class);
    }
}
