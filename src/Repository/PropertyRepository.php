<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }


    /**
     * @return QueryBuilder
     */
    private function _getQuery() : QueryBuilder
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.sold=false');
    }

    /**
     * @return Property[]
     */
    public function getAllVisited(PropertyType $serach) : array
    {
        $query = $this->_getQuery();

        if($serach->getMaxPrice()) {
           $query =  $query->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice',$serach->getMaxPrice());
        }

        if($serach->getMinSurface()) {
            $query = $query->andWhere('p.surface >= :surface')
                ->setParameter('surface',$serach->getMinSurface());
        }

        if($serach->getOptions()) {
            foreach ($serach->getOptions() as $k => $option)
            {
                $query = $query->andWhere(":option$k MEMBER OF p.options")
                    ->setParameter("option$k",$option);
            }
        }

        $propertys = $query->getQuery()->getResult();
        return $propertys;
    }

    /**
     * @return Property[]
     */
    public function getLatestPropertys() : array
    {
        // return the last propertys
        $propertys = $this->_getQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
        return $propertys;
    }



    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
