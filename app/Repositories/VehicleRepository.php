<?php

namespace App\Repositories;

use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Vehicle;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function getAllVehicles()
    {
        return Vehicle::with('user')->get();
    }

    public function getVehicleById($vehicleId)
    {
        if (!Vehicle::find($vehicleId)) {
            return response()->json(['error' => "The vehicle id {$vehicleId} doesn't exist"], 404);
        }

        return Vehicle::with('user')->findOrFail($vehicleId);
    }

    public function createVehicle(array $vehicleDetails)
    {
        return Vehicle::create($vehicleDetails);
    }

    public function updateVehicle($vehicleId, array $newDetails)
    {
        if (!Vehicle::find($vehicleId)) {
            return response()->json(['error' => "This vehicle id {$vehicleId} doesn't exist."], 404);
        }

        return Vehicle::whereId($vehicleId)->update($newDetails);
    }

    public function deleteVehicle($vehicleId)
    {
        if (!Vehicle::find($vehicleId)) {
            return response()->json(['error' => "The vehicle with {$vehicleId} doesn't exist"], 404);
        }

        Vehicle::destroy($vehicleId);
    }
}
