<?php

namespace Bones\StoreBundle\Controller;

use Bones\StoreBundle\Document\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $product = $this->get('doctrine_mongodb')
            ->getRepository('BonesStoreBundle:Product')
            ->findAll();

        $content = array(
            'productList' => $product
        );

        return $this->render('BonesStoreBundle:Default:index.html.twig', $content);
    }


    public function addProductAction(Request $request)
    {
        if ($request->isMethod("POST")) {

            $request = $request->request;

            $formData = $request->get("form");

            $product = new Product();
            $product->setName($formData['name']);
            $product->setPrice($formData['price']);

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($product);
            $dm->flush();

            return $this->redirectToRoute('bones_store_homepage');
        }

        $fb = $this->createFormBuilder();
        $fb
            ->add("name")
            ->add("price")
            ->add('save', new SubmitType(), array(
                      'attr' => array('class' => 'save'),
                    )
            );

        $content = array(
            'form' => $fb->getForm()->createView()
        );
        return $this->render('BonesStoreBundle:Default:add.html.twig', $content);
    }
}
