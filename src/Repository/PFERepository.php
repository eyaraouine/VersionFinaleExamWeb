<?php

namespace App\Repository;

use App\Entity\PFE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PFE>
 *
 * @method PFE|null find($id, $lockMode = null, $lockVersion = null)
 * @method PFE|null findOneBy(array $criteria, array $orderBy = null)
 * @method PFE[]    findAll()
 * @method PFE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PFERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PFE::class);
    }

    public function add(PFE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PFE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function nbPFEs()
    {
        return $this->createQueryBuilder('p')
            ->select('e.designation','count(p.enterprise)')
            ->from('App:Enterprise','e')
            ->andWhere('p.enterprise= e.id')
            ->groupBy('p.enterprise')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return PFE[] Returns an array of PFE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PFE
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
