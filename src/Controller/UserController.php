<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends AbstractController {

    /**
     * @Route("/user", name="user")
     */
    public function index() {
        return $this->render('user/index.html.twig', [
                    'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user_ajout", name="user_ajout")
     */
    public function ajout(Request $request) {
        $user = new User();
        $form = $this->createFormBuilder($user)
                        ->add('prenom', TextType::class)
                        ->add('nom', TextType::class)
                        ->add('save', SubmitType::class, array('label' => 'Ajouter'))->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }


        return $this->render('user/ajout.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/user_liste", name="user_liste")  
     */
    public function liste(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = new User();
        $form = $this->createFormBuilder($user)
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
        $listeUsers = $repository->findAll();
        return $this->render('user/liste.html.twig', ['listeUsers' => $listeUsers, 'form' => $form->createView(),]);
    }

    /**
     * @Route("/user_modifier/{id}", name="user_modifier")
     */
    public function modifier(Request $request) {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($user)
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Modifier'))
                ->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }
        return $this->render('user/modifier.html.twig', ['form' => $form->createView()]);
    }

}
