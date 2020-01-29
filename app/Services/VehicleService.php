<?php

namespace App\Services;

use App\Enums\SortDirectionsEnums;
use App\Enums\VehiclesExpensesSortByEnums;
use Illuminate\Support\Facades\DB;

/**
 * Class VehicleService
 * @package App\Services
 */
class VehicleService
{
    /**
     * @param $data
     * @return mixed
     */
    public function getVehicleExpenses($data)
    {
        $query = $this->build();

        $filteredVehicles = $this->filterData($query, $data);

        return $this->sortVehicles($filteredVehicles, $data);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $fuel = DB::table('fuel_entries')
            ->selectRaw('vehicle_id as id, "fuel" as type, cost AS cost, fuel_entries.entry_date AS created_at');

        $insurance = DB::table('insurance_payments')
            ->selectRaw('vehicle_id as id, "insurance" as type, amount AS cost, insurance_payments.contract_date AS created_at');

        $types = DB::table('services')
            ->selectRaw('vehicle_id as id, "service" as type, total AS cost, services.created_at AS created_at')
            ->union($fuel)
            ->union($insurance);

        return DB::query()
            ->selectRaw('v.*, vehicles.name, vehicles.plate_number')
            ->fromSub($types, 'v')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'v.id');
    }

    /**
     * @param $vehicles
     * @param $data
     * @return mixed
     */
    public function filterData($vehicles, $data)
    {
        if (isset($data['vehicle_name'])) {
            $vehicles->where('vehicles.name', 'like', '%' . $data['vehicle_name'] . '%');
        }

        if (isset($data['expense_type'])) {
            $vehicles->where('type', $data['expense_type']);
        }

        if (isset($data['min_cost'])) {
            $vehicles->where('cost', '>=', $data['min_cost']);
        }

        if (isset($data['max_cost'])) {
            $vehicles->where('cost', '<=', $data['max_cost']);
        }

        if (isset($data['min_creation_date'])) {
            $vehicles->whereDate('v.created_at', '>=', $data['min_creation_date']);
        }

        if (isset($data['max_creation_date'])) {
            $vehicles->whereDate('v.created_at', '<=', $data['max_creation_date']);
        }

        return $vehicles;
    }

    /**
     * @param $vehicles
     * @param $data
     * @return mixed
     */
    public function sortVehicles ($vehicles, $data)
    {
        if (! (isset($data['sort_by']) &&  isset($data['sort_direction']))) {
            return $vehicles->orderBy(VehiclesExpensesSortByEnums::DEFAULT_SORT_BY, SortDirectionsEnums::DEFAULT_SORT_DIRECTION);
        }

        return $vehicles->orderBy($data['sort_by'], $data['sort_direction']);
    }
}
