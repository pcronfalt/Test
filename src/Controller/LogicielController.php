<?php

namespace App\Controller;

use App\Entity\Logiciel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LogicielController extends AbstractController {

    /**
     * @Route("/logiciel", name="logiciel")
     */
    public function index() {
        return $this->render('logiciel/index.html.twig', [
                    'controller_name' => 'LogicielController',
        ]);
    }

    /**
     * @Route("/logiciel_ajout", name="logiciel_ajout")
     */
    public function ajout(Request $request) {
        $logiciel = new Logiciel();
        $form = $this->createFormBuilder($logiciel)
                        ->add('version', TextType::class)
                        ->add('nom', TextType::class)
                        ->add('save', SubmitType::class, array('label' => 'Ajouter'))->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($logiciel);
                $em->flush();
            }
        }


        return $this->render('logiciel/ajout.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/logiciel_liste", name="logiciel_liste")  
     */
    public function liste(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(Logiciel::class);
        $logiciel = new Logiciel();
        $form = $this->createFormBuilder($logiciel)
                ->add('save', SubmitType::class, array('attr' => array('class' => 'save'), 'label' => 'Supprimer'))
                ->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $cocher = $request->request->get('cocher');
                foreach ($cocher as $i) {
                    $u = $repository->find($i);
                    $this->getDoctrine()->getManager()->remove($u);
                } $this->getDoctrine()->getManager()->flush();
            }
        }
        $listeLogiciels = $repository->findAll();
        return $this->render('logiciel/liste.html.twig', ['listeLogiciels' => $listeLogiciels, 'form' => $form->createView(),]);
    }

    /**
     * @Route("/logiciel_modifier/{id}", name="logiciel_modifier")
     */
    public function modifier(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(Logiciel::class);
        $logiciel = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($logiciel)
                ->add('nom', TextType::class)
                ->add('version', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Modifier'))
                ->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($logiciel);
                $em->flush();
            }
        }
        return $this->render('logiciel/modifier.html.twig', ['form' => $form->createView()]);
    }

}
