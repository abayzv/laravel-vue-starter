<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'trip' => new TripResource($this->trip),
            'outlet' => new  OutletResource($this->outlet),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'paid_status' => $this->paid_status,
            'payment_method' => $this->payment_method,
            'created_at' => $this->created_at
        ];
    }
}
