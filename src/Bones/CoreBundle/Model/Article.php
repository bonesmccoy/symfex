<?php

namespace Bones\CoreBundle\Model;

use Bones\CoreBundle\Model\om\BaseArticle;

class Article extends BaseArticle
{
    public function setCountry($country)
    {
        parent::setCountryMeta($country);
    }

    public function getCountry()
    {
        return parent::getCountryMeta();
    }

    public function setFieldWithLongDescription($value)
    {
        parent::setFieldWithLongDescriptionMeta($value);
    }


    public function getFieldWithLongDescription()
    {
        return parent::getFieldWithLongDescriptionMeta();
    }


}
