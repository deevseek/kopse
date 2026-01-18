<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'savings_account_id',
        'trx_type',
        'amount',
        'trx_date',
        'ref_no',
        'description',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'trx_date' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(SavingsAccount::class, 'savings_account_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
