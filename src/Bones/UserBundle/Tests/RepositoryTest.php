<?php


namespace Bones\UserBundle\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RepositoryTest extends KernelTestCase
{

    /**
     * @var EntityManager
     */
    protected static $em;

    public function setUp()
    {
        static::bootKernel();
        static::$em = static::$kernel->getContainer()->get("doctrine")->getManager();
        static::$em->getConnection()->beginTransaction();
    }

    public function tearDown()
    {
        static::$em->getConnection()->rollBack();
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return static::$em->getRepository('BonesUserBundle:User');
    }

    public function testCustomQuery()
    {

        $connection = static::$em->getConnection();
        $statement = $connection->prepare("SELECT count(*), roles FROM fos_user GROUP BY roles;");
        $statement->execute();
        $results = $statement->fetchAll();

        $qb = static::$em->createQueryBuilder();
        $qb->select("COUNT(u.id) as total, u.roles as roles")
            ->from('BonesUserBundle:User', 'u')
            ->groupBy('u.roles');
        static::$em->getConfiguration()->addCustomHydrationMode('UserTotal', 'Bones\UserBundle\Doctrine\UserTotalsHydrator');

        $result = $qb->getQuery()->getResult('UserTotal');

    }
}