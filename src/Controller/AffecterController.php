<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AffecterController extends AbstractController {

    /**
     * @Route("/affecter", name="affecter")    
     */
    public function index() {
       
   
        
       return $this->render('affecter/index.html.twig', [
            'controller_name' => 'FichierController',
        ]);
    }

}
