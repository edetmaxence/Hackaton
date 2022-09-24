<?php

namespace App\Controller;

use App\Entity\Advise;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdviseController extends AbstractController
{
    // #[Route('/advise', name: 'app_advise')]
    // public function index(): Response
    // {
    //     return $this->render('advise/index.html.twig', [
    //         'controller_name' => 'AdviseController',
    //     ]);
    // }

    #[Route('/{id<[0-9]+>}/advise/create', name: 'app_advise_create', methods: 'GET|POST')]
    public function create(Request $request, EntityManagerInterface $em, Restaurant $restaurant): Response
    {
        $advise = new Advise();
        $advise->setRestaurant($restaurant);

        $form = $this->createForm(AdviseType::class, $advise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($advise);
            $em->flush();

            return $this->redirectToRoute('app_restaurants');
        }

        return $this->render('advise/create.html.twig', [
            'advise' => $advise,
            'restaurant' => $restaurant,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id<[0-9]+>}/advise/delete', name: 'app_advise_delete', methods: 'GET')]
    // #[Security("is_granted('ROLE_ADMIN')")]
    public function delete(Advise $advise, EntityManagerInterface $em): Response
    {
        $em->remove($advise);
        $em->flush();

        return $this->redirectToRoute('app_restaurants');
    }

    #[Route('/id<[0-9]+>}/advise/edit', name: 'app_advise_edit', methods: "GET|PUT")]
    // #[Security("is_granted('ROLE_ADMIN')")]
    public function edit(Advise $advise, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(AdviseType::class, $advise, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_restaurants');
        }

        return $this->render('advise/edit.html.twig',  [
            'advise' => $advise,
            'form' => $form->createView()
        ]);
    }
}
