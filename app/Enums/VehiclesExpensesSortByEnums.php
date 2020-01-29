<?php

namespace App\Enums;

class VehiclesExpensesSortByEnums
{
    const CREATION_DATE = 'created_at';
    const COST = 'cost';
    const DEFAULT_SORT_BY = 'cost';

    public static $sortBy = [
      self::CREATION_DATE,
      self::COST
    ];

}
