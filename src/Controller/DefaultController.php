<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

	/**
	 * @Route("/services", name="services")
	 */
    public function service(){
	    return $this->render('services.html.twig', [
		    'controller_name' => 'DefaultController',
	    ]);
    }
}
