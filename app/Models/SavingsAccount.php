<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'saving_type_id',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function savingType()
    {
        return $this->belongsTo(SavingType::class);
    }

    public function transactions()
    {
        return $this->hasMany(SavingsTransaction::class);
    }
}
