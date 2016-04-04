<?php

namespace DiscographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiscographyBundle:Default:index.html.twig');
    }
}
