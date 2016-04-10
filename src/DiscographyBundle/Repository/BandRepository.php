<?php

namespace DiscographyBundle\Repository;

use DiscographyBundle\Entity\Band;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\QueryBuilder;

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
        $bandList = $this->findAll();
        /** @var Band $band */
        foreach ($bandList as $band) {

            $band->setMembers(new ArrayCollection());

            $rsm = new ResultSetMappingBuilder($this->getEntityManager());
            $rsm->addRootEntityFromClassMetadata('DiscographyBundle\Entity\Musician', 'm');
            $rsm->addEntityResult('DiscographyBundle\Entity\Musician', 'm');

            $query = $this->getEntityManager()
                ->createNativeQuery(
                    'SELECT m.* FROM musician m INNER JOIN band_musicians bm ON m.id = bm.musician_id WHERE bm.band_id = ?',
                    $rsm
                );
            $query->setParameter(1, $band->getId());

            foreach ($query->getResult() as $musician) {
                $band->addMember($musician);
            }
        }
        $qb = $this->createQueryBuilder('band');

        return $qb->getQuery()
            ->setFetchMode('DiscographyBundle\Entity\Band', 'members', ClassMetadata::FETCH_EAGER)
            ->execute();
    }
}
