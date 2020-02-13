<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use App\Repository\ServerRepository;
use App\Repository\StateRepository;
use App\Repository\StateUserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/map")
 */
class MapController extends AbstractController
{
    
    
    
    
    /**
     * @Route("/", name="map_index", methods={"GET"})
     */
    public function index(): Response
    {

        
        return $this->render('map/index.html.twig', [

        ]);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * @Route("/worldJson", name="map_world_json", methods={"GET","POST"})
     */
    public function worldJson(Request $request, RegionRepository $regionRepository, ServerRepository $serverRepository): Response
    {
        $response = new JsonResponse();
    
        $server = $serverRepository->find($request->get('id'));
        $regions = $regionRepository->findByServer($server);

        $data = $hexes = [];
        foreach($regions as $index => $region){
   
            $hexes[$region->getId()]['q'] = $region->getX();
            $hexes[$region->getId()]['r'] = $region->getY();
            $hexes[$region->getId()]['type'] = $region->getTypeRegion()->getName();
            $hexes[$region->getId()]['name'] = 0;
            $hexes[$region->getId()]['spawnable'] = $region->getSpawnable();
            if($region->getStateRegion() !== null ){
                $hexes[$region->getId()]['state'] = $region->getStateRegion()->getState()->getId();
            }else{
                $hexes[$region->getId()]['state'] = null;
            }
            
        }
        $data['layout'] = "odd-r";
        $data['hexes'] = $hexes;
        
        $response->setData($data);


        return $response;
	}
    
    /**
     * @Route("/regionInfoJson", name="map_region_info_json", methods={"GET","POST"})
     */
    public function regionInfoJson(Request $request, RegionRepository $regionRepository, StateRepository $stateRepository, StateUserRepository $stateUserRepository): Response
    {
        $response = new JsonResponse();

        $region = $regionRepository->find($request->get('id'));
        if($region->getServer() !== $this->getUser()->getServer()){
            return $response->setData(['Error']);
        }
        
        $data = [];

        $data['region']['id'] = $region->getId();
        $data['region']['x'] = $region->getX();
        $data['region']['y'] = $region->getY();
        $data['region']['spawnable'] = $region->getSpawnable();
        $data['state']['id'] = ($region->getStateRegion() !== null) ? $region->getStateRegion()->getState()->getId(): null;
        $data['state']['name'] = ($region->getStateRegion() !== null) ? $region->getStateRegion()->getState()->getName(): null;
        //if user has nationality
        $data['state']['stateUser'] = (($region->getStateRegion() !== null && $stateUserRepository->findByUserAndState($this->getUser(), $region->getStateRegion()->getState()))? 1 : 0);
        
            
            
            
            

        return $response->setData($data);
	}

    
    
    
    
    
    
    
    
    
    
    
    
}