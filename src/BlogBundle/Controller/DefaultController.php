<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
	return $this->render('BlogBundle:Templates:index_layout.html.twig', array());
    }

}
