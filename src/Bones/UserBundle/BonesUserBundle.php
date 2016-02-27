<?php

namespace Bones\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BonesUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}