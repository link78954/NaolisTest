<?php

namespace Formation\ModelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FormationModelBundle:Default:index.html.twig', array('name' => $name));
    }
}
