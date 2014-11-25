<?php

namespace BonesCoreBundle\Test\Utility;


use Bones\CoreBundle\Utility\Inflector;

class InflectorTest extends \PHPUnit_Framework_TestCase
{

    public function testCamelCaseToUnderscore()
    {
        $this->assertEquals("camel_case_to_underscore",Inflector::camelCaseToUnderscore("CamelCaseToUnderscore"));
    }

    public function testUnderscoreToCamelCase(){
        $this->assertEquals("UnderScoreToCamelCase", Inflector::underscoreToCamelCase("under_score_to_camel_case"));
    }
}

 