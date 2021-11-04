<?php

namespace App\Repository;

use App\Entity\HashGenerates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HashGenerates|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashGenerates|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashGenerates[]    findAll()
 * @method HashGenerates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashGeneratesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HashGenerates::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function store($string_entrada, $hashConcat, $hash, $count)
    {
        $hg = new HashGenerates();

        $hg->setStringEntrada($string_entrada)
            ->setChaveEncontrada($hash)
            ->setHashGerado($hashConcat)
            ->setTentativas($count);

        $this->_em->persist($hg);
        $this->_em->flush();

        return $hg;

    }
}
