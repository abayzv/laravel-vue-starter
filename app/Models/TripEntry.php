<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'outlet_id',
        'quantity',
        'price',
        'isPaid',
        'payment_method'
    ];
}
