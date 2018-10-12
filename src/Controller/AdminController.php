<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Entity\Devis;
use App\Form\DevisBackofficeType;
use App\Service\statutDevisRedirection;
use App\Entity\Newsletter;

class AdminController extends AbstractController
{

	/**
     * @Route("/admin/articles", name="articles")
     */
    public function articles()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repository->findAll();

        return $this->render('admin/articles.html.twig', [
            'controller_name' => 'AdminController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/article/add", name="article_add")
     */
    public function articleAdd(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $article->setDateAjout(new \DateTime());

            if($form->get('image')->getData() != null)
            {
                $file = $form->get('image')->getData();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move($this->getParameter('image_directory'),$fileName);
                
                $article->setImage($fileName);
            }            

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('admin/articleAdd.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'imagePath' => null,
        ]);
    }

    /**
     * @Route("/admin/article/edit/{id}", name="article_edit")
     */
    public function articleEdit(Article $article, Request $request)
    {
        $imagePath = $article->getImage();

        $article->setImage(null);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $article->setDateModification(new \DateTime());

            if($form->get('image')->getData() != null)
            {
                $file = $form->get('image')->getData();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move($this->getParameter('image_directory'),$fileName);
                
                $article->setImage($fileName);
            }
            elseif($imagePath != null) 
            {
                $article->setImage($imagePath);
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('admin/articleEdit.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'imagePath' => $imagePath,
        ]);
    }

    /**
     * @Route("/admin/article/delete/{id}", name="article_delete")
     */
    public function articleDelete(Article $article)
    {      
        $entityManager = $this->getDoctrine()->getManager();      
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('articles');        
    }

    /**
     * @Route("/admin/commentaires", name="commentaires")
     */
    public function commentaires()
    {
        $repository = $this->getDoctrine()->getRepository(Commentaire::class);

        $commentaires = $repository->findAll();

        return $this->render('admin/commentaires.html.twig', [
            'controller_name' => 'AdminController',
            'commentaires' => $commentaires,
        ]);
    }

    /**
     * @Route("/admin/commentaire/delete/{id}", name="commentaire_delete")
     */
    public function commentaireDelete(Commentaire $commentaire)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commentaire);
        $entityManager->flush();

        return $this->redirectToRoute('commentaires');  
    }

    /**
     * @Route("/admin/devis/nouveaux", name="devis_nouveaux")
     */
    public function devisNouveaux()
    {
        $repository = $this->getDoctrine()->getRepository(Devis::class);

        $devis = $repository->findBy(['statut' => 'nouveaux']);

        return $this->render('admin/devisNouveaux.html.twig', [
            'controller_name' => 'AdminController',
            'devis' => $devis,
        ]);
    }

    /**
     * @Route("/admin/devis/enAttente", name="devis_enAttente")
     */
    public function devisEnAttente()
    {
        $repository = $this->getDoctrine()->getRepository(Devis::class);

        $devis = $repository->findBy(['statut' => 'en attente']);

        return $this->render('admin/devisEnAttente.html.twig', [
            'controller_name' => 'AdminController',
            'devis' => $devis,
        ]);
    }

    /**
     * @Route("/admin/devis/signes", name="devis_signes")
     */
    public function devisSignes()
    {
        $repository = $this->getDoctrine()->getRepository(Devis::class);

        $devis = $repository->findBy(['statut' => 'signes']);

        return $this->render('admin/devisSignes.html.twig', [
            'controller_name' => 'AdminController',
            'devis' => $devis,
        ]);
    }    

    /**
     * @Route("/admin/devis/archives", name="devis_archives")
     */
    public function devisArchives()
    {
        $repository = $this->getDoctrine()->getRepository(Devis::class);

        $devis = $repository->findBy(['statut' => 'archives']);

        return $this->render('admin/devisArchives.html.twig', [
            'controller_name' => 'AdminController',
            'devis' => $devis,
        ]);
    }

    /**
     * @Route("/admin/devis/send", name="devis_send")
     */
    public function devisSend()
    {
        return $this->render('admin/devisSend.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/devis/statutSignes/{id}", name="devis_statutSignes")
     */
    public function devisStatutSignes(Devis $devis)
    {
        $devis->setStatut('signes');

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($devis);
        $manager->flush();

        return $this->redirectToRoute('devis_enAttente');
    }

    /**
     * @Route("/admin/devis/statutArchives/{id}", name="devis_statutArchives")
     */
    public function devisStatutArchives(Devis $devis)
    {
        $devis->setStatut('archives');

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($devis);
        $manager->flush();

        return $this->redirectToRoute('devis_signes');
    }

    /**
     * @Route("/admin/devis/add", name="devis_add")
     */
    public function devisAdd(Request $request, statutDevisRedirection $statutDevisRedirection)
    {
        $devis = new Devis();

        $form = $this->createForm(DevisBackofficeType::class, $devis);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $devis->setDateAjout(new \DateTime());
            $devis->setCaseNewsletter(0);
            $devis->setCaseObligatoire(1);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($devis);
            $manager->flush();

            $statutDevis = $devis->getStatut();

            $redirectionStatut = $statutDevisRedirection->redirectStatut($statutDevis);

            return $this->redirectToRoute($redirectionStatut); 
        }

        return $this->render('admin/devisAdd.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/devis/edit/{id}", name="devis_edit")
     */
    public function devisEdit(Devis $devis, Request $request, statutDevisRedirection $statutDevisRedirection)
    {
        $form = $this->createForm(DevisBackofficeType::class, $devis);
        
        $devis->setCaseObligatoire(1);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $devis->setDateModification(new \DateTime());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($devis);
            $manager->flush();

            $statutDevis = $devis->getStatut();

            $redirectionStatut = $statutDevisRedirection->redirectStatut($statutDevis);

            return $this->redirectToRoute($redirectionStatut); 
        }

        return $this->render('admin/devisEdit.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/devis/delete/{id}", name="devis_delete")
     */
    public function devisDelete(Devis $devis, statutDevisRedirection $statutDevisRedirection)
    {
        $statutDevis = $devis->getStatut();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($devis);
        $entityManager->flush();

        $redirectionStatut = $statutDevisRedirection->redirectStatut($statutDevis);

        return $this->redirectToRoute($redirectionStatut);   
    }

    /**
     * @Route("/admin/newsletter/list", name="newsletter_list")
     */
    public function newsletterList()
    {
        $repository = $this->getDoctrine()->getRepository(Newsletter::class);

        $newsletters = $repository->findAll();

        return $this->render('admin/newsletterList.html.twig', [
            'controller_name' => 'AdminController',
            'newsletters' => $newsletters,
        ]);
    }

    /**
     * @Route("/admin/newsletter/delete/{id}", name="newsletter_delete")
     */
    public function newsletterDelete(Newsletter $newsletter)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($newsletter);
        $entityManager->flush();

        return $this->redirectToRoute('newsletter_list');   
    }   

    
}
