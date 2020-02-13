<?php

namespace App\Controller;

use App\Entity\State;
use App\Entity\StateUser;
use App\Form\StateType;
use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;
/**
 * @Route("/state")
 */
class StateController extends AbstractController
{
    /**
     * @Route("/", name="state_index", methods={"GET"})
     */
    public function index(StateRepository $stateRepository): Response
    {
        
        $states = $stateRepository->findByServer($this->getUser()->getServer());
        
        return $this->render('state/index.html.twig', [
            'states' => $states,
        ]);
    }
    

    

    /**
     * @Route("/new", name="state_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $state = new State();
        
        $role = $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $form = $this->createForm(StateType::class, $state, array('role' => $role));
        if(!$role){
            $state->setStatut("Awainting");
        }    
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            
            $state->setServer($this->getUser()->getServer());
            $state->setUserCreator($this->getUser());
            
            $entityManager->persist($state);
            $entityManager->flush();
            
            //add StateUser Nationality
            $stateUser = new StateUser();
            $stateUser->setUser($this->getUser());
            $stateUser->setState($state);
            
            $entityManager->persist($stateUser);
            $entityManager->flush();

            return $this->redirectToRoute('state_index');
        }

        return $this->render('state/new.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_show", methods={"GET"})
     */
    public function show(State $state): Response
    {
        return $this->render('state/show.html.twig', [
            'state' => $state,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="state_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, State $state): Response
    {
        
        $role = $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $form = $this->createForm(StateType::class, $state, array('role' => $role));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('state_index');
        }

        return $this->render('state/edit.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_delete", methods={"DELETE"})
     */
    public function delete(Request $request, State $state): Response
    {
        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($state);
            $entityManager->flush();
        }

        return $this->redirectToRoute('state_index');
    }
}
