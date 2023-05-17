<?php

declare(strict_types=1);

namespace App\Util;

final class PaginationUtil
{
    /**
     * with $page and $pageSize we want to ensure
     * that they are at least 1.
     */
    public static function calculateOffset(int $page, int $pageSize): int
    {
        $page = max(1, $page);
        $pageSize = max(1, $pageSize);

        return ($page - 1) * $pageSize;
    }
}