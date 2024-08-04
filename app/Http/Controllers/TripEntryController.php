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
        $searchBy = $request->input('search_by');
        $searchQuery = $request->input('query');

        $query = TripEntry::query();
        $query->orderBy('created_at');

        if ($searchBy === 'outlet_name' && $searchQuery) {
            $query->whereHas('outlet', function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($searchBy === 'driver_name' && $searchQuery) {
            $query->whereHas('trip.user', function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($request->has('paid_status')) {
            $query->where('paid_status', $request->input('paid_status'));
        }

        if ($request->has('payment_method')) {
            $query->where('paid_status', 1);
            $query->where('payment_method', $request->input('payment_method'));
        }

        $perPage = $request->input('per_page', 10);
        $trips = $query->paginate($perPage);

        $filtersData = [
            "paid_status" => [
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
            "payment_method" => [
                "label" => "Jenis Pembayaran",
                "name" => "payment_method",
                "type" => 'select',
                "data" => [
                    [
                        "label" => "Transfer",
                        "value" => "transfer"
                    ],
                    [
                        "label" => "Cash",
                        "value" => "cash"
                    ],
                ],
            ],
            "paid_status" => [
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
