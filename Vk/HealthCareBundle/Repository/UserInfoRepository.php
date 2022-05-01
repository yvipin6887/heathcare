<?php

namespace App\Vk\HealthCareBundle\Repository;

use App\Vk\HealthCareBundle\Entity\UserInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserInfoRepository extends ServiceEntityRepository{

        public function __construct(ManagerRegistry $registry)
        {
                parent::__construct($registry, UserInfo::class);
        }

        // /**
    //  * @return UserInfo[] Returns an array of UserInfo objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    public function findOneBySomeField($value): ?UserInfo
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getUserByAllPost()
    {
        return $this->createQueryBuilder('u')
            ->select('u.profile,up.id,up.title,up.description,up.image,up.datetime')
            ->innerJoin('u.userPost','up')
            // ->andWhere('u.exampleField = :val')
            // ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ; 
    }
    
}