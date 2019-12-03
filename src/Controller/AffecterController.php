<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Affecter;

class AffecterController extends AbstractController {

    /**
     * @Route("/affecter", name="affecter")    
     */
    public function index() {
        $affecter = new Affecter();
        $form = $this->createFormBuilder($affecter)
                        ->add('user', EntityType::class, array('class' => 'App\Entity\User', 'choice_label' => 'nom'))
                        ->add('logiciel', EntityType::class, array('class' => 'App\Entity\Logciel', 'choice_label' => 'nom'))
                        ->add('save', SubmitType::class, array('label' => 'Ajouter'))->getForm();
        return $this->render('affecter/index.html.twig', ['form' => $form->createView(),]);
    }

}
