<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;
use Spatie\Permission\Models\Role;

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

    public static function getRoles()
    {
        return Role::all()->map(function ($role) {
            return [
                'label' => $role->name,
                'value' => $role->id
            ];
        });
    }
}
