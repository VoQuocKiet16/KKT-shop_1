<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function cart($value): array
   {
       return $this->createQueryBuilder('c')
       ->select('c.id, p.namep, c.quantity, p.pricep, p.image, c.quantity*p.pricep as total ')
           ->andWhere('c.user = :val')
           ->setParameter('val', $value)
           ->innerJoin('c.product', 'p')
           ->getQuery()
           ->getArrayResult()
       ;
   }


   /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function findcart($value): array
    {
        return $this->createQueryBuilder('c')
        ->select('p.id, c.quantity,  p.image, p.pricep*c.quantity as total')
        ->innerJoin('c.product', 'p')
        ->innerJoin('c.user', 'u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function finduserid($value): array
   {
       return $this->createQueryBuilder('c')
       ->select('c.id')
           ->andWhere('c.user = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getArrayResult()
       ;
   }

}
