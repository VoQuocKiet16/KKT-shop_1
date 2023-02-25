<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function add(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



          /**
        * @return Order[] Returns an array of Order objects
        */
       public function userinfo($value): array
       {
        return $this->createQueryBuilder('o')
        ->select('u.name, u.phone, u.address ')
        ->innerJoin('o.userorder', 'u')
        ->andWhere('o.userorder = :val')
        ->setParameter('val', $value)
        ->orderBy('o.id', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getResult()
        ;
       }
        //     /**
        // * @return Order[] Returns an array of Order objects
        // */
        // public function productdetail($value): array
        // {
        //     return $this->createQueryBuilder('o')
        //         ->select('p.namep, p.pricep, o.quantity, p.pricep*o.quantity as total')
        //         ->innerJoin('o.product', 'p')
        //         ->andWhere('o.product= :val')
        //         ->setParameter('val', $value)
        //         ->getQuery()
        //         ->getResult()
        //     ;
        // }

       /**
        * @return Order[] Returns an array of Order objects
        */
       public function billproduct($value): array
       {
           return $this->createQueryBuilder('o')
               ->select('od.quantity, p.namep, p.price')
               ->innerJoin('o.oid', 'od')
               ->innerJoin('od.pid', 'p')
               ->andWhere('o.id = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getResult()
           ;
       }

       
       /**
        * @return Order[] Returns an array of Order objects
        */
       public function orderdetail($value): array
       {
           return $this->createQueryBuilder('o')
           ->select('max(o.id) as oid')
               ->andWhere('o.userorder = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getResult()
           ;
       }

        /**
        * @return Order[] Returns an array of Order objects
        */
        public function date($value): array
        {
            return $this->createQueryBuilder('o')
                ->select('o.datecreate')
                ->andWhere('o.id= :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult()
            ;
        }
                 /**
        * @return Order[] Returns an array of Order objects
        */
        public function totalbill($value): array
        {
            return $this->createQueryBuilder('o')
            ->select('o.total')
            ->andWhere('o.userorder = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        }


          /**
        * @return Order[] Returns an array of Order objects
        */
        public function totaldetail($value): array
        {
            return $this->createQueryBuilder('o')
            ->select('o.Total')
            ->andWhere('o.id = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        }



}
