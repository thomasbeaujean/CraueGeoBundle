<?php

namespace Craue\GeoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * GeoPostalCodeRepository
 *
 */
class GeoPostalCodeRepository extends EntityRepository
{
    /**
     * Get the geopostalcodes by the names
     *
     * @param $names array The names
     */
    public function findByNames($names, $qb = null)
    {
        //the entity manager
        $em = $this->getEntityManager();

        if ($qb === null) {
            $qb = $this->createQueryBuilder('geoPostalCode');
            $qb->select('geoPostalCode');
        }

        $index = 0;
        $subQuery = '';

        if ($names !== null) {
            foreach ($names as $name) {
                //there is no OR if it is the first time we use the subquery
                if ($index !== 0) {
                    $subQuery .= ' OR ';
                }
                $parameterName = 'name'.$index;
                $subQuery .= 'geoPostalCode.name like :'.$parameterName;
                $qb->setParameter($parameterName, $name);
                $index++;
            }
        }

        //the subquery contains all the or filters
        if ($subQuery !== null) {
            $qb->andWhere($subQuery);
        }

        //if no filters were provided, no festivals are found
        if ($names === null) {
            $results = array();
        } else {
            $results = $qb->getQuery()->getResult();
        }

        return $results;
    }

    /**
     * Get one geopostalcode by the names
     *
     * @param array $names
     *
     * @return array The city attributes
     */
    public function findOneByNames($names, $qb = null)
    {
        $city = null;
        $cities = $this->findByNames($names, $qb);

        if (count($cities) > 0) {
            $city = $cities[0];
        }

        return $city;
    }
}
