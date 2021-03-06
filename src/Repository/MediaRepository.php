<?php

namespace App\Repository;

use App\Entity\Media;
use App\Entity\MediaCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Media|null find($id, $lockMode = null, $lockVersion = null)
 * @method Media|null findOneBy(array $criteria, array $orderBy = null)
 * @method Media[]    findAll()
 * @method Media[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Media::class);
    }

    /**
     * @param MediaCategories $category
     * @return Media[]
     */
    public function findByCategory(MediaCategories $category): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = true')
            ->andWhere('p.deleted = false')
            ->andWhere('p.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.update_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByActive(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = true')
            ->andWhere('p.deleted = false')
            ->orderBy('p.update_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByIsDisabled(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = false')
            ->andWhere('p.deleted = false')
            ->orderBy('p.update_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByIsDeleted(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.deleted = true')
            ->orderBy('p.update_date', 'DESC')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Media[] Returns an array of Media objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Media
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
