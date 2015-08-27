<?php

namespace Givenchy\EyelipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GivenchyEyelipBundle:Default:index.html.twig', array('name' => $name));
    }
}
