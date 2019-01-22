<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 19.01.19
 * Time: 16:52
 */

namespace App\Repository;

use App\Entity\Result;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ResultRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Result::class);
    }

    /**
     * @param int $value
     * @return array
     */
    public function findResultsByQuestion(int $value)
    {
        return $this->createQueryBuilder('r')
            ->innerJoin('r.digitResult', 'dr')
            ->addSelect('dr')
            ->andWhere('r.question = :val')
            ->andWhere('r.isDeleted = :del')
            ->setParameters([
                'val' => $value,
                'del' => false
            ])
            ->getQuery()
            ->execute()
        ;
    }
}