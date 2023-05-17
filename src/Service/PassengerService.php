<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Journey;
use App\Entity\Passenger;
use App\Enum\JourneyStatus;
use App\Repository\JourneyRepository;
use App\Repository\PassengerRepository;
use App\Util\PaginationUtil;
use App\ValueObject\PassengerDetails;
use DateTimeImmutable;
use Exception;

class PassengerService
{
    public function __construct(
        private PassengerRepository $passengerRepository,
        private JourneyRepository $journeyRepository
    )
    {
    }

    public function createJourneyForPassenger(
        int $passengerId,
        string $pickUpAddress,
        string $dropOffAddress,
        DateTimeImmutable $pickUpDateTime
    ): void {
        $passenger = $this->passengerRepository->find($passengerId);

        $calculatedDistanceForJourney = $this->calculateDistanceInKm($pickUpAddress, $dropOffAddress);
        if ($passenger->getLeftBudgetInKm() < $calculatedDistanceForJourney) {
            throw new Exception('Not enough budget left');
        }
        $journey = new Journey();
        $journey->setDistanceInKm($calculatedDistanceForJourney);
        $journey->setTaxiCompany($passenger->getArea()->getTaxiCompany());
        $journey->setPassenger($passenger);
        $journey->setPickUpAddress($pickUpAddress);
        $journey->setDropOffAddress($dropOffAddress);
        $journey->setStatus(JourneyStatus::WAITING_DEPARTURE);
        $journey->setPickUpDateTime($pickUpDateTime);
        $this->journeyRepository->save($journey);
    }

    /**
     * @return PassengerDetails[]
     */
    public function getAllPassengers(?string $city, int $page, int $pageSize): array
    {
        $offset = PaginationUtil::calculateOffset($page, $pageSize);

        $criteria = [];
        if (!is_null($city)) {
            $criteria['city'] = $city;
        }

        $passengers = $this->passengerRepository->findBy($criteria, null, $pageSize, $offset);

        return array_map(
            fn(Passenger $passenger) => PassengerDetails::fromEntity($passenger),
            $passengers
        );
    }

    /**
     * @TODO do the calculation with Google Map API
     */
    private function calculateDistanceInKm(string $pickUpAddress, string $dropOffAddress): float
    {
        return 3.5;
    }
}