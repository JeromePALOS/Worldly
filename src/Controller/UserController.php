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


class UserController extends AbstractController
{
    /**
     * @Route("/user/admin/", name="user_index", methods={"GET"})
     */
    public function index(GrantedService $grantedService): Response
    {    
        if (!$grantedService->isGranted($this->getUser(), 'ROLE_ADMIN')) {
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        
        
        $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findByServer($this->getUser()->getServer());
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
        
    }

    /**
     * @Route("/user/new", name="user_new", methods={"GET"})
     */
    public function new(Request $request): Response
    {
        throw new AccessDeniedException('Page under construction');
    }
    

    
    
    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/admin/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(GrantedService $grantedService, Request $request, User $user): Response
    {

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
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(GrantedService $grantedService, Request $request, User $user): Response
    {

        
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
