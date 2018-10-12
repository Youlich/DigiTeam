<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Entity\Devis;
use App\Form\DevisType;
use App\Service\addNewsletter;

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
	 * @Route("/nos-services", name="services")
	 */
    public function service(){
	    return $this->render('services.html.twig');
    }

	/**
	 * @Route("/presentation-de-notre-agence-Digiteam", name="agenceDigiTeam")
	 */
	public function agency(){
		return $this->render('agency.html.twig');
	}

	/**
	 * @Route("/nos-expertises", name="expertise")
	 */
	public function expertise(){
		return $this->render('expertise.html.twig');
	}

	/**
	 * @Route("/notre-blog", name="blog")
	 */
	public function blog(){
		return $this->render('blog.html.twig');
	}

	/**
	 * @Route("/contact-Digiteam", name="contact")
	 */
	public function contact(Request $request, addNewsletter $addNewsletter)
	{
		$contact = new Contact();

		$form = $this->createForm(ContactType::class,$contact);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$manager = $this->getDoctrine()->getManager();

			if($contact->getCaseNewsletter() == 'true')
			{
				$newsletter = $addNewsletter->add($contact);
				$manager->persist($newsletter);
			}


			$manager->persist($contact);
			$manager->flush();

			return $this->redirectToRoute('accueil');
		}
		return $this->render('contact.html.twig', [
			'controller_name' => 'DefaultController',
			'form' => $form->createView(),
		]);
	}




	/**
	 * @Route("/article", name="article")
	 */
	public function article(){
		return $this->render('articleBlog.html.twig');
	}

	/**
	 * @Route("/authentification-administration", name="authentification")
	 */
	public function authentif(){
		return $this->render('authentification.html.twig');
	}

	/**
 * @Route("/plan-du-site", name="siteMap")
 */
	public function sitemap(){
		return $this->render('siteMap.html.twig');
	}

	/**
	 * @Route("/Mentions-Legales", name="mentionsLegales")
	 */
	public function mentionsLegales(){
		return $this->render('mentionsLegales.html.twig');
	}

	/**
	 * @Route("/mail", name="mail")
	 */
	public function mail(){
		return $this->render('/emails/sendDevis.html.twig');
	}

	/**
	 * @Route("/devis-Digiteam", name="devis")
	 */
	public function devis(Request $request, addNewsletter $addNewsletter)
	{
		$devis = new Devis();

		$form = $this->createForm(DevisType::class, $devis);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$devis->setDateAjout(new \DateTime());
			$devis->setStatut('nouveaux');

			$manager = $this->getDoctrine()->getManager();

			if($devis->getCaseNewsletter() == 'true')
			{
				$newsletter = $addNewsletter->add($devis);
				$manager->persist($newsletter);
			}

			$manager->persist($devis);
			$manager->flush();

			return $this->redirectToRoute('accueil');
		}

		return $this->render('contact.html.twig', [
			'controller_name' => 'DefaultController',
			'form' => $form->createView(),
		]);
	}

}
