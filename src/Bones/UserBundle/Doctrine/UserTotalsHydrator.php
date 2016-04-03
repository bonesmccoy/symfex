<?php


namespace Bones\UserBundle\Doctrine;


use Bones\UserBundle\Entity\UserTotal;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use PDO;

class UserTotalsHydrator  extends AbstractHydrator
{

    /**
     * Hydrates all rows from the current statement instance at once.
     *
     * @return array
     */
    protected function hydrateAllData()
    {
        $result = array();
        $cache  = array();
        foreach($this->_stmt->fetchAll() as $row) {
            $this->hydrateRowData($row, $result);
        }

        return $result;
    }

    /**
     * @param array $row
     * @param array $result
     */
    protected function hydrateRowData(array $row, array &$result)
    {
        $row['total'] = $row['sclr_0'];
        $row['roles'] = unserialize($row['roles_1']);
       $result[] = UserTotal::factory($row);
    }

}