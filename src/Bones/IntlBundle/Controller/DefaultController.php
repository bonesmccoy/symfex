<?php

namespace Bones\IntlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BonesIntlBundle:Default:index.html.twig', array('name' => $name));
    }
}
