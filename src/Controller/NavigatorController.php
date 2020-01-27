<?php

namespace App\Controller;

use App\Entity\State;
use App\Form\StateType;
use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;
use App\Repository\NavigatorRepository;
/**
 * @Route("/nav")
 */
class NavigatorController extends AbstractController
{
    
    /**
     * @Route("/", name="nav_index", methods={"GET"})
     */
    public function index(StateRepository $stateRepository, UserRepository $userRepository, $route): Response
    {
        //state ou est la personne
        //state nationalité

        
        
        
        $menu = array(
            "states" => $userRepository->find($this->getUser()->getId())->getStateCreates()
            
        
        
        );
        return $this->render('nav.html.twig', [
            'menu' => $menu,
            'route' => $route
        ]);
    }
    
    
}