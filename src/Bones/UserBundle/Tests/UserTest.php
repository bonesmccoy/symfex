<?php

namespace Bones\UserBundle\Tests;



use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserTest extends KernelTestCase
{

    /** @var  EntityManager */
    protected $em;

    public function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()->get("doctrine")->getManager();
        $this->em->getConnection()->beginTransaction();
    }

    public function tearDown()
    {
        $this->em->getConnection()->rollBack();
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
            $this->em->remove($facebookUser);
        }

        $this->em->flush();

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
        return $this->em->getRepository('BonesUserBundle:User');
    }

}
