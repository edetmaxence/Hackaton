<?php

namespace App\Controller;

use App\Entity\Restaurant;
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

    #[Route('/api/restaurants/{id}', name: 'app_restaurants_details', methods: ['GET'])]
    public function getDetailRestaurant(Restaurant $restaurant, SerializerInterface $serializer): JsonResponse
    {
        $jsonRestaurant = $serializer->serialize($restaurant, 'json');
        return new JsonResponse($jsonRestaurant, Response::HTTP_OK, ['accept' => 'json'], true);
    }

    #[Route('/restaurants/{id}', name: 'app_restaurants_show', methods: ['GET'])]
    public function showRestaurant(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', compact('restaurant'));
    }
}
