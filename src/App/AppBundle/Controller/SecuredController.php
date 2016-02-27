<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SecuredController extends Controller
{

    public function indexAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render('AppAppBundle:Default:index.html.twig', array(
            'user' => $user
        ));
    }
}
