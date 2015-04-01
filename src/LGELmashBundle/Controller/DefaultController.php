<?php

namespace LGELmashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/versus")
     * @Template()
     */
    public function versusAction()
    {
        return array();
    }

    /**
     * @Route("/classement")
     * @Template()
     */
    public function classementAction()
    {
        return array();
    }

    /**
     * @Route("/suggestion")
     * @Template()
     */
    public function suggestionAction()
    {
        return array();
    }
}
