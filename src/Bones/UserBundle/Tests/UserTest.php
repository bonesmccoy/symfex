<?php

namespace Bones\UserBundle\Tests;



use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Hautelook\AliceBundle\Alice\DataFixtures\Fixtures\Loader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    /** @var  EntityManager */
    private static $em;

    private static $fixtures;

    public static function setUpBeforeClass()
    {
        self::bootKernel();
        /** @var EntityManager $em */
        static::$em = static::$kernel->getContainer()->get("doctrine")->getManager();
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::$em = static::$kernel->getContainer()->get("doctrine")->getManager();
        static::$em->getConnection()->beginTransaction();
    }

    public function tearDown()
    {
        static::$em->getConnection()->rollBack();
    }

    public function testUsersLoadedInDB()
    {
        $users = $this->getUserRepository()->findAll();

        $this->assertCount(24, $users);
    }

    public function testDeleteRows()
    {
        $users = $this->getUserRepository()->findAll();

        $totalUsers = count($users);

        $criteria = new Criteria();
        $criteria->where($criteria->expr()->neq('facebook_id', null));

        $facebookUsers = $this->getUserRepository()->matching($criteria);

        $totalFacebookUsers = count($facebookUsers);

        foreach($facebookUsers as $facebookUser) {
            static::$em->remove($facebookUser);
        }

        static::$em->flush();

        $users = $this->getUserRepository()->findAll();

        $this->assertEquals($totalUsers - $totalFacebookUsers, count($users));
    }

    public function testUsersWithFacebookLogin()
    {
        $criteria = new Criteria();
        $criteria->where($criteria->expr()->neq('facebook_id', null));

        $users = $this->getUserRepository()->matching($criteria);

        $this->assertCount(8, $users);
    }



    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getUserRepository()
    {
        return static::$em->getRepository('BonesUserBundle:User');
    }



}
