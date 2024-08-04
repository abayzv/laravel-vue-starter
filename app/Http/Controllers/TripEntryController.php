<?php

namespace App\Http\Controllers;

use App\Models\TripEntry;
use App\Http\Requests\StoreTripEntryRequest;
use App\Http\Requests\UpdateTripEntryRequest;
use App\Http\Resources\TripEntryResource;
use App\Services\SelectDataService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TripEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TripEntry::query();

        // Filter berdasarkan user_id
        if ($request->has('paid_status')) {
            $query->where('paid_status', $request->input('paid_status'));
        }

        // Pagination
        $perPage = $request->input('per_page', 10); // Default 10 per halaman
        $trips = $query->paginate($perPage);

        // Select-data
        $filtersData = [
            "user" => [
                "label" => "Status Pembayaran",
                "name" => "paid_status",
                "type" => 'select',
                "data" => [
                    [
                        "label" => "Belum dibayar",
                        "value" => 0
                    ],
                    [
                        "label" => "Lunas",
                        "value" => 1
                    ],
                ],
            ],
        ];

        return Inertia::render('TripEntry/View', [
            'data' => TripEntryResource::collection($trips),
            'filters' => [
                "data" => $filtersData,
                "default" => $request->all()
            ],
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
    public function store(StoreTripEntryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TripEntry $tripEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripEntry $tripEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripEntryRequest $request, TripEntry $tripEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripEntry $tripEntry)
    {
        //
    }
}
