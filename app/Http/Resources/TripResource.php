<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'driver' => new UserResource($this->user),
            'vehicle' => new VehicleResource($this->vehicle),
            'departure_date' => $this->departure_date,
            'departure_time' => $this->departure_time,
        ];
    }
}
