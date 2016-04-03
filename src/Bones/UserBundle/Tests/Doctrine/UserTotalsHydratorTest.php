<?php

namespace Bones\UserBundle\Tests\Doctrine;

use Bones\UserBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserTotalsHydratorTest
 */
class UserTotalsHydratorTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected static $em;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();
        static::$em = static::$kernel->getContainer()->get("doctrine")->getManager();
        static::$em->getConnection()->beginTransaction();
    }

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function tearDown()
    {
        static::$em->getConnection()->rollBack();
    }

    /**
     * @see \Bones\UserBundle\Repository\UserCustomRepository::getTotalGroupByRole()
     */
    public function testCustomQueryAndHydrator()
    {
        /** @var UserRepository $userCustomRepository */
        $userCustomRepository = static::$kernel->getContainer()->get('bones.repository.user_custom');

        $result = $userCustomRepository->getTotalGroupByRole();

        foreach ($result as $userTotal) {
            $this->assertInstanceOf('\Bones\UserBundle\Entity\UserTotal', $userTotal);
        }

    }
}
