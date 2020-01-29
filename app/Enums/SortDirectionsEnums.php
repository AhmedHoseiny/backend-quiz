<?php

namespace App\Enums;

class SortDirectionsEnums
{
    const ASCENDING = 'asc';
    const DESCENDING = 'desc';
    const DEFAULT_SORT_DIRECTION = 'asc';

    public static $sortDirection = [
        self::ASCENDING,
        self::DESCENDING
    ];
}
