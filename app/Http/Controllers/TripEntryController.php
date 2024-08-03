<?php

namespace App\Http\Controllers;

use App\Models\TripEntry;
use App\Http\Requests\StoreTripEntryRequest;
use App\Http\Requests\UpdateTripEntryRequest;

class TripEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
