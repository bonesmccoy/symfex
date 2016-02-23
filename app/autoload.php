<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

/**
 * @var ClassLoader $loader
 */

$loader = require __DIR__.'/../vendor/autoload.php';

$loader->add('Propel' , __DIR__.'/../vendor/bundles');
$loader->add('Phing' , __DIR__.'/../vendor/phing/classes/phing');

AnnotationDriver::registerAnnotationClasses();
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
