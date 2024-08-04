<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Hitung total trip
        $totalTrips = Trip::count();

        // Hitung total driver dengan role 'driver'
        $totalDrivers = User::role('driver')->count();

        // Hitung total kendaraan
        $totalVehicles = Vehicle::count();

        // Hitung total outlet
        $totalOutlets = Outlet::count();

        $data = [
            'totalTrips' => $totalTrips,
            'totalDrivers' => $totalDrivers,
            'totalVehicles' => $totalVehicles,
            'totalOutlets' => $totalOutlets
        ];

        return Inertia::render('Dashboard', [
            'data' => $data
        ]);
    }
}
