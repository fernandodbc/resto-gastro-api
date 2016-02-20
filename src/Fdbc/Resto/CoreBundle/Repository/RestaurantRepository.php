<?php

namespace Fdbc\Resto\CoreBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * RestaurantRepository
 */
class RestaurantRepository extends DocumentRepository
{
    public function getRestaurants($parameters, $limit = null, $skip = null)
    {
        $qb = $this->createQueryBuilder()->find();

        if (!empty($parameters['q'])) {
            $qb->addOr($qb->expr()->field('name')->equals(new \MongoRegex('/.*'.$parameters['q'].'.*/i')));
            $qb->addOr($qb->expr()->field('address')->equals(new \MongoRegex('/.*'.$parameters['q'].'.*/i')));
            $qb->addOr($qb->expr()->field('zip_code')->equals(new \MongoRegex('/'.$parameters['q'].'.*/i')));
            $qb->addOr($qb->expr()->field('city')->equals(new \MongoRegex('/.*'.$parameters['q'].'.*/i')));
        }

        if (!empty($parameters['name'])) {
            $qb->field('name')->equals(new \MongoRegex('/.*'.$parameters['name'].'.*/i'));
        }

        if (isset($parameters['address']) && !empty($parameters['address'])) {
            $qb->field('address')->equals(new \MongoRegex('/.*'.$parameters['address'].'.*/i'));
        }

        if (isset($parameters['zip_code']) && !empty($parameters['zip_code'])) {
            $qb->field('zip_code')->equals(new \MongoRegex('/'.$parameters['zip_code'].'.*/i'));
        }

        if (isset($parameters['city']) && !empty($parameters['city'])) {
            $qb->field('city')->equals(new \MongoRegex('/.*'.$parameters['city'].'.*/i'));
        }
        
        if (!empty($limit)) {
            $qb->limit($limit);
        }

        if (!empty($skip)) {
            $qb->skip($skip);
        }

        $qb->sort('inspectionDate', 'desc');

        return $qb->getQuery()->execute();
    }
}
