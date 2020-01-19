<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use App\Service\GrantedService;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(GrantedService $grantedService): Response
    {
               
        if (!$grantedService->isGranted($this->getUser(), 'ROLE_ADMIN')) {
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        
        $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
        
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(GrantedService $grantedService, Request $request): Response
    {
        
        if (!$grantedService->isGranted($this->getUser(), 'ROLE_ADMIN')) {
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(GrantedService $grantedService, Request $request, User $user): Response
    {
        
        if (!$grantedService->isGranted($this->getUser(), 'ROLE_ADMIN')) {
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(GrantedService $grantedService, Request $request, User $user): Response
    {
        if (!$grantedService->isGranted($this->getUser(), 'ROLE_ADMIN')) {
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            
            foreach($user->getStates() as $state){
                $state->setUserCreator(null);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
