<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VehicleService
{
    public function release($vehicle)
    {
        // Release car with no owner
        $vehicle->update([
            'user_id' => NULL
        ]);

        return $vehicle;
    }

    public function setOwner($vehicle, $user)
    {
        // Update vehicle owner
        $vehicle->update([
            'user_id' => $user->id
        ]);

        return $vehicle;
    }
}
