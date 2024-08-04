<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Models\User;
use App\Services\SelectDataService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchBy = $request->input('search_by');
        $searchQuery = $request->input('query');

        $query = Trip::query();

        if ($searchBy === 'driver_name' && $searchQuery) {
            $query->whereHas('user', function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->has('vehicle_id')) {
            $query->where('vehicle_id', $request->input('vehicle_id'));
        }

        if ($request->has('departure_date')) {
            $query->where('departure_date', $request->input('departure_date'));
        }

        $perPage = $request->input('per_page', 10);
        $trips = $query->paginate($perPage);

        $filtersData = [
            "user" => [
                "label" => "Driver",
                "name" => "user_id",
                "type" => 'select',
                "data" => SelectDataService::getUsers(),
            ],
            "vehicle" => [
                "label" => "Kendaraan",
                "name" => "vehicle_id",
                "type" => 'select',
                "data" => SelectDataService::getVehicles(),
            ],
            "departure_date" => [
                "label" => "Tanggal Berangkat",
                "name" => "departure_date",
                "type" => 'date',
            ]
        ];

        return Inertia::render('Trip/View', [
            'data' => TripResource::collection($trips),
            'filters' => [
                "data" => $filtersData,
                "default" => $request->all()
            ],
            'search' => [
                'data' => $request->all()
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
