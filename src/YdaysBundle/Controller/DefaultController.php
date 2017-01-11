<?php

namespace YdaysBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YdaysBundle:Default:index.html.twig');
    }
}
