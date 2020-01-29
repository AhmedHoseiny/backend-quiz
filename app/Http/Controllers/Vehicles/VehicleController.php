<?php

namespace App\Http\Controllers\Vehicles;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleExpensesRequest;
use App\Http\Resources\vehiclesResource;
use App\Services\VehicleService;
use Illuminate\Http\Request;

/**
 * Class VehicleController
 * @package App\Http\Controllers\Vehicles
 */
class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    private $vehicleService;

    /**
     * VehicleController constructor.
     * @param VehicleService $vehicleService
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getExpenses(VehicleExpensesRequest $request)
    {
        $vehicles = $this->vehicleService->getVehicleExpenses($request->all());

        return  response(['expenses' => vehiclesResource::collection($vehicles->paginate())]);
    }
}
