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
        return $this->render('index.html.twig');
    }

	/**
	 * @Route("/services", name="services")
	 */
    public function service(){
	    return $this->render('services.html.twig');
    }

	/**
	 * @Route("/agency", name="agency")
	 */
	public function agency(){
		return $this->render('agency.html.twig');
	}

	/**
	 * @Route("/expertise", name="expertise")
	 */
	public function expertise(){
		return $this->render('expertise.html.twig');
	}

	/**
	 * @Route("/blog", name="blog")
	 */
	public function blog(){
		return $this->render('blog.html.twig');
	}

	/**
	 * @Route("/contact", name="contact")
	 */
	public function contact(){
		return $this->render('contact.html.twig');
	}

	/**
	 * @Route("/article", name="article")
	 */
	public function article(){
		return $this->render('ArticleBlog.html.twig');
	}

	/**
	 * @Route("/authentif", name="authentification")
	 */
	public function authentif(){
		return $this->render('authentification.html.twig');
	}

	/**
	 * @Route("/test", name="test")
	 */
	public function test(){
		return $this->render('administration.html.twig');
	}







}
