<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Area;
use App\Entity\Passenger;
use App\Repository\AreaRepository;
use App\Repository\PassengerRepository;
use App\Util\PaginationUtil;
use App\ValueObject\PassengerDetails;

final class AreaService
{
    public function __construct(private readonly PassengerRepository $passengerRepository)
    {
    }

    /**
     * @return PassengerDetails[]
     */
    public function getPassengersByAreaId(int $areaId, int $page, int $pageSize): array
    {
        $offset = PaginationUtil::calculateOffset($page, $pageSize);

        $passengers = $this->passengerRepository->findBy(['area' => $areaId], null, $pageSize, $offset);

        return array_map(
            fn(Passenger $passenger) => PassengerDetails::fromEntity($passenger),
            $passengers
        );
    }
}