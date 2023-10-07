<?php

namespace App\Repository;

use App\Entity\Action;
use App\Entity\ActionStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActionStatus>
 *
 * @method ActionStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionStatus[]    findAll()
 * @method ActionStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionStatus::class);
    }

    /**
     * @return ?ActionStatus
     */
    public function findByKeyAndId(string $key, string $id): ?ActionStatus
    {
        $byId = $this->findBy(['actorId' => $id]);
        $result = [];
        foreach ($byId as $item) {
            if ($item->getAction()->getProcessor() === $key) {
                return $item;
            }
        }

        return null;
    }

//    public function findOneBySomeField($value): ?ActionStatus
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
