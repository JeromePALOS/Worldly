<?php

namespace App\Controller;

use App\Entity\StateRegion;
use App\Entity\State;
use App\Form\StateRegionType;
use App\Repository\StateRegionRepository;
use App\Repository\RegionRepository;
use App\Repository\StateRepository;
use App\Repository\StateUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stateregion")
 */
class StateRegionController extends AbstractController
{
    /**
     * @Route("/admin/", name="state_region_index", methods={"GET"})
     */
    public function index(StateRegionRepository $stateRegionRepository): Response
    {
        return $this->render('state_region/index.html.twig', [
            'state_regions' => $stateRegionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="state_region_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stateRegion = new StateRegion();
        $role = $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        $form = $this->createForm(StateRegionType::class, $stateRegion, array('role' => $role));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            

            $entityManager->persist($stateRegion);
            $entityManager->flush();

            return $this->redirectToRoute('state_region_index');
        }

        return $this->render('state_region/new.html.twig', [
            'state_region' => $stateRegion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="state_region_show", methods={"GET"})
     */
    public function show(StateRegion $stateRegion): Response
    {
        return $this->render('state_region/show.html.twig', [
            'state_region' => $stateRegion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="state_region_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StateRegion $stateRegion): Response
    {
        $form = $this->createForm(StateRegionType::class, $stateRegion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('state_region_index');
        }

        return $this->render('state_region/edit.html.twig', [
            'state_region' => $stateRegion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="state_region_delete", methods={"DELETE"})
     */
    public function delete(Request $request, StateRegion $stateRegion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stateRegion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stateRegion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('state_region_index');
    }
    
    
    /**
     * @Route("/state-{idstate}/spawnable", name="state_region_spawnable", methods={"GET","POST"})
     */
    public function spawnable(Request $request, StateRepository $stateRepository, RegionRepository $regionRepository, StateUserRepository $stateUserRepository): Response
    {
        $stateRegion = new StateRegion();

        if ($request->isMethod('POST') ) {    
            
            //si region est bien spawnable et a un pas deja un pays
            
            
            $entityManager = $this->getDoctrine()->getManager();
            
            $state = $stateRepository->find($request->get('idstate'));
            if($stateUserRepository->findByUserAndState($this->getUser(), $state) == null){
                throw new AccessDeniedException('You don\'t have permission.');
            }
            
            
            $region = $regionRepository->find($request->get('region'));
            if($region->getSpawnable() == 0){
                throw new AccessDeniedException('You don\'t have permission.');
            }
            
            
            
            
            $stateRegion->setState($state);
            $stateRegion->setRegion($region);

            $entityManager->persist($stateRegion);
            $entityManager->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('state_region/spawnable.html.twig', [
            'state_region' => $stateRegion
        ]);
    }
    
    
    
}
