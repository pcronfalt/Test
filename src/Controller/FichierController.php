<?php

namespace App\Controller;

use App\Entity\Fichier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FichierController extends AbstractController
{
    /**
     * @Route("/fichier", name="fichier")
     */
    public function index()
    {
        return $this->render('fichier/index.html.twig', [
            'controller_name' => 'FichierController',
        ]);
    }
    
    /**
     * @Route("/fichier_ajout", name="fichier_ajout")
     */
    public function ajout(Request $request) {
        $fichier = new Fichier();
        $form = $this->createFormBuilder($fichier)
                ->add('nom', TextType::class)
                ->add('date', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',))
                ->add('extension', TextType::class)
                ->add('taille', IntegerType::class)
                ->add('utilisateur_id', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Ajouter'))
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fichier);
                $em->flush();
            }
        }

        return $this->render('fichier/ajout.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/fichier_liste", name="fichier_liste") 
     */
    public function liste(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(Fichier::class);
        $listeFichiers = $repository->findAll();
        return $this->render('fichier/liste.html.twig', [
                    'listeFichiers' => $listeFichiers,
        ]);
    }    
}
