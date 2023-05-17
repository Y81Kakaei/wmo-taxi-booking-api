<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Journey;
use App\Repository\JourneyRepository;
use App\Util\PaginationUtil;
use App\ValueObject\JourneyDetails;

final class TaxiCompanyService
{
    public function __construct(private readonly JourneyRepository $journeyRepository)
    {
    }

    /**
     * @return JourneyDetails[]
     */
    public function getJourneysForTaxiCompany(int $taxiCompanyId, int $page, int $pageSize): array
    {
        $offset = PaginationUtil::calculateOffset($page, $pageSize);

        $journeys = $this->journeyRepository->findBy(
            ['taxiCompany' => $taxiCompanyId],
            null,
            $pageSize,
            $offset
        );

        return array_map(
            fn(Journey $journey) => JourneyDetails::fromEntity($journey),
            $journeys
        );
    }
}