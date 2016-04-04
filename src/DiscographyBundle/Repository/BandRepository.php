<?php

namespace DiscographyBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * BandRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BandRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAllWithMembers()
    {
        $qb = $this->createQueryBuilder('band');

        return $qb->getQuery()->setFetchMode('DiscographyBundle::Musician', 'members', ClassMetadata::FETCH_EAGER)->getResult();

    }
}