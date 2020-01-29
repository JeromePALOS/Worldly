<?php

namespace App\Controller;

use App\Entity\StateUser;
use App\Entity\State;
use App\Form\StateUserType;
use App\Repository\StateUserRepository;
use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/stateuser")
 */
class StateUserController extends AbstractController
{
    /**
     * @Route("/", name="state_user_index", methods={"GET"})
     */
    public function index(StateUserRepository $stateUserRepository): Response
    {
        return $this->render('state_user/index.html.twig', [
            'state_users' => $stateUserRepository->findAll(),
        ]);
    }
    


    /**
     * @Route("/new", name="state_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stateUser = new StateUser();
        $form = $this->createForm(StateUserType::class, $stateUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stateUser);
            $entityManager->flush();

            return $this->redirectToRoute('state_user_index');
        }

        return $this->render('state_user/new.html.twig', [
            'state_user' => $stateUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_user_show", methods={"GET"})
     */
    public function show(StateUser $stateUser): Response
    {
        return $this->render('state_user/show.html.twig', [
            'state_user' => $stateUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="state_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StateUser $stateUser): Response
    {
        $form = $this->createForm(StateUserType::class, $stateUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('state_user_index');
        }

        return $this->render('state_user/edit.html.twig', [
            'state_user' => $stateUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, StateUser $stateUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stateUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stateUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('state_user_index');
    }
}
