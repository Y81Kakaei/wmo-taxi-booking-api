<?php

namespace App\Controller;

use App\Service\TaxiCompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaxiCompanyController extends AbstractController
{
    public function __construct(private readonly TaxiCompanyService $taxiCompanyService)
    {
    }

    #[Route('/taxi-companies/{companyId}/journeys', name: 'app_taxi_company_get_journeys')]
    public function getAllJourneys(int $companyId, Request $request): JsonResponse
    {
        /**
         * A taxi company must be able to request
         * journeys for which they are responsible;
         */
        $page = $request->query->getInt('page', 1);
        $pageSize = $request->query->getInt('pageSize', 50);

        return $this->json($this->taxiCompanyService->getJourneysForTaxiCompany($companyId, $page, $pageSize));
    }
}
