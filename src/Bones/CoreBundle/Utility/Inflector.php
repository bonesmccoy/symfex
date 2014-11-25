<?php

namespace Bones\CoreBundle\Utility;

class Inflector
{

    /**
     * @param $string
     * @return string
     */
    public static function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace( '/([A-Z])/', '_$1', lcfirst( $string )));
    }

    /**
     * @param $string
     * @return string
     */
    public static function underscoreToCamelCase($string)
    {
        return str_replace(" ", "", ucwords(str_replace("_", " ", strtolower($string))));
    }
}
