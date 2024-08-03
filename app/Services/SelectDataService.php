<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;

class SelectDataService
{
    public static function getUsers()
    {
        return User::role('driver')->get()->map(function ($user) {
            return [
                'label' => $user->name,
                'value' => $user->id
            ];
        });
    }

    public static function getVehicles()
    {
        return Vehicle::all()->map(function ($vehicle) {
            return [
                'label' => $vehicle->name,
                'value' => $vehicle->id
            ];
        });
    }
}
