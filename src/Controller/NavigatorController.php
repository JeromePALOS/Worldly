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

class NavigatorController extends AbstractController
{
    
    /**
     * @Route("/nav/", name="nav_nav", methods={"GET"})
     */
    public function nav(StateRepository $stateRepository, UserRepository $userRepository, $route): Response
    {
        //state ou est la personne
        //state nationalité

        
        
        
        $menu = array(
            "stateUsers" => $this->getUser()->getStateUsers()
            
        
        
        );
        return $this->render('nav/nav.html.twig', [
            'menu' => $menu,
            'route' => $route
        ]);
    }
    
    
    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function index(StateRepository $stateRepository, UserRepository $userRepository): Response
    {
        
        $actions = array();
        
        $stateCreates = $this->getUser()->getStateCreates();
        if(count($stateCreates) < 1){
            $createState = array(
                'title' => '',
                'btn' => 'Create State',
                'link' => '/state/new'
            );
            array_push($actions, $createState);
        }else{
            foreach($stateCreates as $state){
                if(count($state->getStateRegions()) < 1){
                    $createState = array(
                        'title' => 'Choose a location to found my state',
                        'btn' => 'Found my state',
                        'link' => "/stateregion/state-".$state->getId()."/spawnable"
                    );
                    array_push($actions, $createState);
                    
                }  
            }
        }
        
        return $this->render('index.html.twig', [
            'actions' => $actions
        ]);
    }
    
    
}