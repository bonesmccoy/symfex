<?php

namespace App\AppBundle\Controller;

use Bones\UserBundle\Form\Registration\BuyerRegistrationType;
use Bones\UserBundle\Form\Registration\SellerRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{

    public function registerBuyerAction()
    {
        $form = $this->createForm(new BuyerRegistrationType());

        return $this->render('AppAppBundle:Registration:register.html.twig', array(
                'form' => $form->createView()
            ));
    }

    public function registerSellerAction()
    {
        $form = $this->createForm(new SellerRegistrationType());
        return $this->render('AppAppBundle:Registration:register.html.twig', array(
                'form' => $form->createView()
            ));
    }

}
