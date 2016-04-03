<?php

namespace Bones\UserBundle\Repository;

use Bones\UserBundle\Entity\UserTotal;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserCustomRepository
 */
class UserRepository extends EntityRepository
{

    /**
     * fetch user Totals grouped by Role
     * @return UserTotal[]
     */
    public function getTotalGroupByRole()
    {
        $this
            ->getEntityManager()
            ->getConfiguration()
            ->addCustomHydrationMode('UserTotal', 'Bones\UserBundle\Doctrine\UserTotalsHydrator');

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select("COUNT(u.id) as total, u.roles as roles")
            ->from('BonesUserBundle:User', 'u')
            ->groupBy('u.roles');

        return $qb->getQuery()->getResult('UserTotal');
    }
}
