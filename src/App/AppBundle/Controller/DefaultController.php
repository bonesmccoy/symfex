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

    public function createAction()
    {
        $article = new Article();
        $article->setTitle("TITLE");
        $article->setCountry("CA");
        $article->setFieldWithLongDescription(substr(md5(time()), 0, rand(5, 20)));
        $article->save();
    }


    public function showAction()
    {
        foreach(ArticleQuery::create()->find() as $article) {
            var_dump($article->getCountry());
            var_dump($article->getFieldWithLongDescription());
            var_dump($article);
        }

    }
}
