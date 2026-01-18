<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'member_type',
        'class_name',
        'gender',
        'phone',
        'address',
        'join_date',
        'status',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Member $member) {
            if (! $member->member_no) {
                $member->member_no = self::generateMemberNumber();
            }
        });
    }

    public static function generateMemberNumber(): string
    {
        $year = now()->year;
        $lastNumber = static::withTrashed()
            ->whereYear('created_at', $year)
            ->orderByDesc('member_no')
            ->value('member_no');

        $sequence = 1;
        if ($lastNumber) {
            $parts = explode('/', $lastNumber);
            $lastSequence = (int) end($parts);
            $sequence = $lastSequence + 1;
        }

        return sprintf('AGT/%s/%06d', $year, $sequence);
    }
}
