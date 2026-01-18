<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingType extends Model
{
    protected $fillable = [
        'code',
        'name',
        'is_withdrawable',
        'is_periodic',
        'default_amount',
        'is_active',
    ];

    protected $casts = [
        'is_withdrawable' => 'boolean',
        'is_periodic' => 'boolean',
        'default_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }
}
