<?php

namespace DiscographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BandController
 * @package DiscographyBundle\Controller
 */
class BandController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexLazyAction()
    {
        $bandList = $this->getDoctrine()->getRepository('DiscographyBundle:Band')->findAll();

        return $this->render(
            'DiscographyBundle:Band:index.html.twig',
            [
                'bandList' => $bandList,
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexEagerAction()
    {
        $bandList = $this
            ->getDoctrine()
            ->getRepository('DiscographyBundle:Band')
            ->findAllWithMembers();

        return $this->render(
            'DiscographyBundle:Band:index.html.twig',
            [
                'bandList' => $bandList,
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAvidAction()
    {
        $bandList = $this
            ->getDoctrine()
            ->getRepository('DiscographyBundle:Band')
            ->findAll();

        $bandList = $this
            ->getDoctrine()
            ->getRepository('DiscographyBundle:Musician')
            ->populateBandWithMembers($bandList);

        return $this->render(
            'DiscographyBundle:Band:index.html.twig',
            [
                'bandList' => $bandList,
            ]
        );
    }

}
