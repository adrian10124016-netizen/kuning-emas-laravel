<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'discount_percent',
        'description',
        'is_active',
    ];

    protected $casts = [
        'discount_percent' => 'integer',
        'is_active' => 'boolean',
    ];
}