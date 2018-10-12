<?php

namespace App\Service;
use App\Entity\Newsletter;

class addNewsletter
{
    public function add($entite)
    {
    	$nom = $entite->getNom();
    	$prenom = $entite->getPrenom();
    	$email = $entite->getEmail();
    	$caseNewsletter = $entite->getCaseNewsletter();

        $newsletter = new Newsletter();
        $newsletter->setNom($nom);
        $newsletter->setPrenom($prenom);
        $newsletter->setEmail($email);
        $newsletter->setCaseObligatoire($caseNewsletter);

        return $newsletter;
    }
}