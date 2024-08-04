<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Http\Resources\OutletResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Nette\Utils\Strings;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchBy = $request->input('search_by');
        $searchQuery = $request->input('query');

        $query = Outlet::query();

        if ($searchBy && $query) {
            $query->where($searchBy, 'like', '%' . $searchQuery . '%');
        }

        $perPage = $request->input('per_page', 10);
        $outlet = $query->paginate($perPage);

        return Inertia::render('Outlet/View', [
            'data' => OutletResource::collection($outlet),
            'filters' => [],
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
    public function store(StoreOutletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outlet $outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutletRequest $request, Outlet $outlet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        //
    }
}
