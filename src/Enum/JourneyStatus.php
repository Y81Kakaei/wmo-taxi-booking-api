<?phpdeclare(strict_types=1);namespace App\Enum;enum JourneyStatus: string{    case WAITING_DEPARTURE = 'waiting-departure';    case UNDER_WAY = 'under-way';    case ARRIVED = 'arrived';    case CANCELLED = 'cancelled';}