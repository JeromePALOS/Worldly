<?php

namespace App\Controller;

use App\Entity\TypeRegion;
use App\Form\TypeRegionType;
use App\Repository\TypeRegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/type/region")
 */
class TypeRegionController extends AbstractController
{
    /**
     * @Route("/", name="type_region_index", methods={"GET"})
     */
    public function index(TypeRegionRepository $typeRegionRepository): Response
    {
        return $this->render('type_region/index.html.twig', [
            'type_regions' => $typeRegionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_region_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeRegion = new TypeRegion();
        $form = $this->createForm(TypeRegionType::class, $typeRegion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeRegion);
            $entityManager->flush();

            return $this->redirectToRoute('type_region_index');
        }

        return $this->render('type_region/new.html.twig', [
            'type_region' => $typeRegion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_region_show", methods={"GET"})
     */
    public function show(TypeRegion $typeRegion): Response
    {
        return $this->render('type_region/show.html.twig', [
            'type_region' => $typeRegion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_region_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeRegion $typeRegion): Response
    {
        $form = $this->createForm(TypeRegionType::class, $typeRegion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_region_index');
        }

        return $this->render('type_region/edit.html.twig', [
            'region_type' => $typeRegion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_region_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeRegion $typeRegion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeRegion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeRegion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_region_index');
    }
}
