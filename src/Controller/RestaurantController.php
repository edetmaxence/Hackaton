<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/restaurants', name: 'app_restaurant')]
    public function index(RestaurantRepository $RestaurantRepository): JsonResponse
    {
        $rests = $RestaurantRepository->findAll();
        return $this->json([
                'resto'=> $rests,
                
        ]);
        
    }
}
