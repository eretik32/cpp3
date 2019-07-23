<?php

namespace CoreBundle\Repository;

use CoreBundle\Entity\Product;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     *
     * @return Product[]
     */
    public function findActive()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('CoreBundle:Product','p')
            ->innerJoin('p.imageModeration','cp')
            ->getQuery()
            ->getResult();
    }

}
