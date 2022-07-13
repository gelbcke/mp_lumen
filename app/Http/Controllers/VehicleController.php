<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    protected $vehicleService;
    private VehicleRepositoryInterface $vehicleRepository;

    /**
     * Construct Repository and Service
     *
     * @param VehicleService $vehicleService
     * @param VehicleRepositoryInterface $vehicleRepository
     */
    public function __construct(VehicleService $vehicleService, VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleService = $vehicleService;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * List all vehicles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            ['data' => $this->vehicleRepository->getAllVehicles()],
            200
        );
    }

    /**
     * Create new vehicle
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validatePostRequest($request);

        $vehicleDetails = $request->only([
            'brand', 'model', 'plate', 'user_id'
        ]);

        return response()->json(
            ['data' => $this->vehicleRepository->createVehicle($vehicleDetails)],
            201
        );
    }

    /**
     * See vehicle details
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $vehicleId = $request->route('id');

        return response()->json(
            ['data' => $this->vehicleRepository->getVehicleById($vehicleId)],
            200
        );
    }

    /**
     * Update vechicle details
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validatePutRequest($request);

        $vehicleId = $request->route('id');

        $vehicleDetails = $request->only([
            'brand', 'model', 'user_id'
        ]);

        return response()->json(
            ['data' =>  $this->vehicleRepository->updateVehicle($vehicleId, $vehicleDetails)],
            200
        );
    }

    /**
     * Delete vehicle
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $vehicleId = $request->route('id');

        return response()->json(
            ['data' => $this->vehicleRepository->deleteVehicle($vehicleId)],
            410
        );
    }

    /**
     * Set user_id to vehicle
     *
     * @param Request $request
     * @param [type] $vehicleId
     * @return void
     */
    public function setOwner(Request $request, $vehicleId)
    {
        $user = User::find($request->user_id);
        $vehicle = Vehicle::find($vehicleId);

        if (!$user) {
            return response()->json(['message' => "The user with id {$request->user_id} doesn't exist"], 404);
        }

        if (!$vehicle) {
            return response()->json(['message' => "The vehicle with id {$vehicleId} doesn't exist"], 404);
        }

        $vehicle = $this->vehicleService
            ->setOwner($vehicle, $user);

        return response()->json(['data' => "The {$user->name} is the new owner of vehicle plate {$vehicle->plate}."], 200);
    }

    /**
     * Set null on vehicles->user_id
     *
     * @param [type] $vehicleId
     * @return void
     */
    public function release($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);

        if (!$vehicle) {
            return response()->json(['message' => "The vehicle with id {$vehicleId} doesn't exist"], 404);
        }

        $vehicle = $this->vehicleService
            ->release($vehicle);

        return response()->json(['data' => "The vehicle with {$vehicle->plate} plate is released!"], 200);
    }

    /**
     * Request validate for POST method
     *
     * @param Request $request
     * @return void
     */
    public function validatePostRequest(Request $request)
    {
        $rules = [
            'brand' => 'required',
            'model' => 'required',
            'plate' => 'required|unique:vehicles|min:6'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Request validate for PUT/PATCH method
     *
     * @param Request $request
     * @return void
     */
    public function validatePutRequest(Request $request)
    {
        $rules = [
            'brand' => 'required',
            'model' => 'required',
            'user_id' => 'required'
        ];

        $this->validate($request, $rules);
    }
}
