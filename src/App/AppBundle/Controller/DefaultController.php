<?php

namespace App\AppBundle\Controller;

use Bones\CoreBundle\Model\Article;
use Bones\CoreBundle\Model\ArticleQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render('AppAppBundle:Default:index.html.twig', array(
            'user' => $user
        ));
    }

}
