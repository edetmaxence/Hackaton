<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    #[Route('/api/restaurants', name: 'app_restaurants', methods: ['GET'])]
    public function getRestaurantList(RestaurantRepository $restaurantRepository, SerializerInterface $serializer): JsonResponse
    {
        $restaurantList = $restaurantRepository->findAll();

        $jsonRestaurantList = $serializer->serialize($restaurantList, 'json');
        return new JsonResponse($jsonRestaurantList, Response::HTTP_OK, [], true);
    }
}
