<?php

namespace App\Controller;

use App\Entity\Telechargement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TelechargementController extends AbstractController
{
    /**
     * @Route("/telechargement", name="telechargement")
     */
    public function index()
    {
        return $this->render('telechargement/index.html.twig', [
            'controller_name' => 'TelechargementController',
        ]);
    }
    
    /**
     * @Route("/telechargement_ajout", name="telechargement_ajout")
     */
    public function ajout(Request $request) {
        $telechargement = new Telechargement();
        $form = $this->createFormBuilder($telechargement)
                ->add('nb', IntegerType::class)
                ->add('utilisateur_id', IntegerType::class)
                ->add('fichier_id', IntegerType::class)
                ->add('save', SubmitType::class, array('label' => 'Ajouter'))
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($telechargement);
                $em->flush();
            }
        }

        return $this->render('telechargement/ajout.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/telechargement_liste", name="telechargement_liste") 
     */
    public function liste(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(Telechargement::class);
        $listeTelechargements = $repository->findAll();
        return $this->render('telechargement/liste.html.twig', [
                    'listeTelechargements' => $listeTelechargements,
        ]);
    }
}
