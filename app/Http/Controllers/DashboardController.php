<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Outlet;
use App\Services\ChartDataService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalTrips = Trip::count();
        $totalDrivers = User::role('driver')->count();
        $totalVehicles = Vehicle::count();
        $totalOutlets = Outlet::count();

        $data = [
            'totalTrips' => $totalTrips,
            'totalDrivers' => $totalDrivers,
            'totalVehicles' => $totalVehicles,
            'totalOutlets' => $totalOutlets,
            'tripEntryCharts' => ChartDataService::getTripEntryChart($request),
            // 'driverDropCharts' => ChartDataService::getDriverDropChart($request)
        ];

        return Inertia::render('Dashboard', [
            'data' => $data,
            'query' => count($request->all()) ? $request->all() : null
        ]);
    }
}
