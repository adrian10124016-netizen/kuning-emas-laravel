<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'guest_name',
        'guest_phone',
        'reservation_date',
        'seating_time',
        'guest_count',
        'status',
        'notes',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];
}