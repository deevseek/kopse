<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CooperativeSetting extends Model
{
    protected $fillable = [
        'cooperative_name',
        'school_name',
        'address',
        'phone',
        'logo_path',
        'simpanan_pokok_amount',
        'simpanan_wajib_amount',
        'shu_cadangan_percent',
        'shu_anggota_percent',
    ];
}
