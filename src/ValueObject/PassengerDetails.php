<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Passenger;
use JsonSerializable;

class PassengerDetails implements JsonSerializable
{
    private function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $address,
        public readonly string $city
    ) {
    }
    public static function fromEntity(Passenger $passenger): self
    {
        return new self(
            $passenger->getId(),
            $passenger->getName(),
            $passenger->getAddress(),
            $passenger->getCity()
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}