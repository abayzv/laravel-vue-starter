<?php

namespace App\Services;

use App\Models\TripEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ChartDataService
{
    public static function getTripEntryChart($request)
    {
        $filterType = $request->input('filter', 'weekly');
        $startDate = now()->subDays(7)->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        if ($filterType == 'monthly') {
            $month = $request->input('month', now()->format('Y-m'));
            $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth()->format('Y-m-d');
        }

        $tripEntries = TripEntry::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                'paid_status',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date', 'paid_status')
            ->get()
            ->groupBy('paid_status');

        $categories = [];
        $series = [];
        foreach ($tripEntries as $status => $entries) {
            $data = [];
            foreach ($entries as $entry) {
                if (!in_array($entry->date, $categories)) {
                    $categories[] = $entry->date;
                }
                $data[] = $entry->count;
            }
            $series[] = [
                'name' => $status ? 'Lunas' : 'Belum dibayar',
                'data' => $data
            ];
        }

        return [
            "categories" => $categories,
            "series" => $series
        ];
    }

    public static function getDriverDropChart($request)
    {
        $filterType = $request->input('driver_filter', 'weekly');
        $startDate = now()->subDays(7)->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        if ($filterType == 'monthly') {
            $month = $request->input('driver_month', now()->format('Y-m'));
            $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth()->format('Y-m-d');
        }

        $roleDriverId = Role::where('name', 'driver')->value('id');

        $driverDrops = TripEntry::whereBetween('trip_entries.created_at', [$startDate, $endDate])
            ->join('trips', 'trip_entries.trip_id', '=', 'trips.id')
            ->join('users', 'trips.user_id', '=', 'users.id')
            ->join('model_has_roles', function ($join) use ($roleDriverId) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $roleDriverId);
            })
            ->select('users.name as driver_name', DB::raw('COUNT(*) as drop_count'))
            ->groupBy('users.name')
            ->get();

        $categories = $driverDrops->pluck('driver_name')->toArray();
        $data = $driverDrops->pluck('drop_count')->toArray();

        $series = [
            [
                'name' => 'Jumlah Drop',
                'data' => $data
            ]
        ];

        return [
            "categories" => $categories,
            "series" => $series
        ];
    }
}
