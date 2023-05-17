<?php

namespace App\Controller;

use App\Service\PassengerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PassengerController extends AbstractController
{
    public function __construct(private PassengerService $passengerService)
    {
    }
    #[Route('/passengers/{passengerId}/journeys', name: 'app_passengers_create_new_journey', methods: ['POST'])]
    public function createJourneyForPassenger(int $passengerId): JsonResponse
    {
        // fetch passenger
        $this->passengerService->createJourneyForPassenger($passengerId);

        //calculate the km

        //return $this->json($passengerDetails);
    }

    #[Route('/passengers', name: 'app_passengers_list_all', methods: ['GET'])]
    public function getAllPassengers(Request $request): JsonResponse
    {
        /**
         * A call center must be able to retrieve all
         * residents of the municipality of Utrecht;
         */
        $page = $request->query->getInt('page', 1);
        $pageSize = $request->query->getInt('pageSize', 50);

        $city = $request->get('city');

        $passengerDetailsDtos = $this->passengerService->getAllPassengers($city, $page, $pageSize);

        return $this->json($passengerDetailsDtos);
    }
}
