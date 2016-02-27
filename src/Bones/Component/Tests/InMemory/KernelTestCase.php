<?php


namespace Bones\Component\Tests\InMemory;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;

class KernelTestCase extends BaseKernelTestCase
{

    public static function createDatabase(EntityManager $em)
    {
        // Clear Doctrine to be safe
        $em->clear();

        // Schema Tool to process our entities
        $tool = new SchemaTool($em);
        $classes = $em->getMetaDataFactory()->getAllMetaData();

        // Drop all classes and re-build them for each test case
        $tool->dropSchema($classes);
        $tool->createSchema($classes);
    }

}
