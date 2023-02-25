<?php

namespace App\Repository;

use App\Entity\OrderDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDetail>
 *
 * @method OrderDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetail[]    findAll()
 * @method OrderDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetail::class);
    }

    public function add(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrderDetail[] Returns an array of OrderDetail objects
//     */
//    public function findorderdetail($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->select('pro.namep, pro.pricep, o.quantity, pro.pricep*o.quantity as total')
//            ->innerJoin('o.pid', 'pro')
//            ->innerJoin('o.pid', 'ord')
//            ->andWhere('o.oid= :id')
//            ->setParameter('id', $value)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderDetail
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

            /**
        * @return OrderDetail[] Returns an array of OrderDetail objects
        */
        public function productdetail($value): array
        {
            return $this->createQueryBuilder('o')
                ->select('p.namep, p.pricep, o.quantity')
                ->innerJoin('o.product', 'p')
                ->andWhere('o.orderid = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult()
            ;
        }
}
