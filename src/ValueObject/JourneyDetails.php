<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Journey;
use DateTimeImmutable;

final class JourneyDetails implements \JsonSerializable
{
    private function __construct(
        public readonly int $id,
        public readonly string $pickupAddress,
        public readonly string $dropOffAddress,
        public readonly float $distanceInKm,
        public readonly DateTimeImmutable $pickUpDateTime,
        public readonly string $status,
    ) {}

    public static function fromEntity(Journey $journey): self
    {
        return new self(
            $journey->getId(),
            $journey->getPickUpAddress(),
            $journey->getDropOffAddress(),
            $journey->getDistanceInKm(),
            $journey->getPickUpDateTime(),
            $journey->getStatus(),
        );
    }

    public function jsonSerialize(): mixed
    {
        $data = get_object_vars($this);
        $data['pickUpDateTime'] = $this->pickUpDateTime->format('d-m-Y h:i');

        return $data;
    }
}