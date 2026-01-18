<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    protected $fillable = [
        'code',
        'name',
        'max_principal',
        'max_tenor_months',
        'interest_rate',
        'admin_fee',
        'penalty_per_day',
        'is_active',
    ];

    protected $casts = [
        'max_principal' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'penalty_per_day' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
