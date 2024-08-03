<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\SelectDataService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = User::with('roles')->paginate(10);
        $query = User::query();

        // Filter berdasarkan user_id
        if ($request->has('role_id')) {
            $roleId = $request->input('role_id');
            $roleName = Role::findById($roleId)->name; // Dapatkan nama peran dari ID
            $query->role($roleName);
        }

        // Pagination
        $perPage = $request->input('per_page', 10); // Default 10 per halaman
        $users = $query->paginate($perPage);

        // Select-data
        $filtersData = [
            "role" => [
                "label" => "Role",
                "name" => "role_id",
                "type" => 'select',
                "data" => SelectDataService::getRoles(),
            ],
        ];

        return Inertia::render('User/View', [
            'data' => UserResource::collection($users),
            'filters' => [
                "data" => $filtersData,
                "default" => $request->all()
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
