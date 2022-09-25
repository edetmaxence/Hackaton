<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    // #[Route('/api/restaurants', name: 'app_restaurants', methods: ['GET'])]
    // public function getRestaurantList(RestaurantRepository $restaurantRepository, SerializerInterface $serializer): JsonResponse
    // {
    //     $restaurantList = $restaurantRepository->findAll();

    //     $jsonRestaurantList = $serializer->serialize($restaurantList, 'json');
    //     return new JsonResponse($jsonRestaurantList, Response::HTTP_OK, [], true);
    // }


    // #[Route('/api/restaurants/{id}', name: 'app_restaurants_details', methods: ['GET'])]
    // public function getDetailRestaurant(Restaurant $restaurant, SerializerInterface $serializer): JsonResponse
    // {
    //     $jsonRestaurant = $serializer->serialize($restaurant, 'json');
    //     return new JsonResponse($jsonRestaurant, Response::HTTP_OK, ['accept' => 'json'], true);
    // }
    #[Route('/restaurants', name: 'app_restaurants')]
    public function showAll(RestaurantRepository $restaurantRepository): Response
    {
        $restaurants = $restaurantRepository->findAll();

        return $this->render('restaurant/all.html.twig', [
            'restaurants' => $restaurants
        ]);
    }


    #[Route('/restaurants/{id<[0-9]+>}', name: 'app_restaurants_show', methods: ['GET'])]
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', compact('restaurant'));
    }


    #[Route('/restaurants/{id<[0-9]+>}', name: 'app_restaurants_delete', methods: 'DELETE')]
    // #[Security("is_granted('ROLE_ADMIN')")]
    public function delete(Restaurant $restaurant, EntityManagerInterface $em): Response
    {
        $em->remove($restaurant);
        $em->flush();

        return $this->redirectToRoute('/restaurants');
    }

    #[Route('/restaurants/create', name: 'app_restaurants_create', methods: 'GET|POST')]
    // #[Security("is_granted('ROLE_ADMIN')")]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $restaurant = new Restaurant;

        $form = $this->createForm(RestaurantType::class, $restaurant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($restaurant);
            $em->flush();

            return $this->redirectToRoute('app_restaurants');
        }

        return $this->render('restaurant/create.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form->createView()
        ]);
    }

    #[Route('/restaurants/update/{id<[0-9]+>}', name: 'app_restaurants_edit', methods: 'GET|PUT|POST')]
    public function update(Restaurant $restaurant, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(RestaurantType::class, $restaurant, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('restaurant/edit.html.twig',  [
            'restaurant' => $restaurant,
            'form' => $form->createView()
        ]);
    }
}
