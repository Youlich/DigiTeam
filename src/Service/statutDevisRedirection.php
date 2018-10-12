<?php

namespace App\Service;

class statutDevisRedirection
{
    public function redirectStatut($statutDevis)
    {
        switch ($statutDevis) 
        {
		    case "nouveaux":
		        $redirectionStatut = 'devis_nouveaux';
		        break;
		    case "en attente":
		        $redirectionStatut = 'devis_enAttente';
		        break;
		    case "signes":
		        $redirectionStatut = 'devis_signes';
		        break;
		    case "archives":
		    	$redirectionStatut = 'devis_archives';
		    	break;
		}

		return $redirectionStatut;
    }
}