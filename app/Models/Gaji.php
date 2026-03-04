<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $fillable = [
        'karyawan_id',
        'gaji_pokok',
        'tj_perumahan',
        'tj_kemahalan',
        'total_gaji'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    protected static function booted()
    {
        static::saving(function ($gaji) {
            $gaji->total_gaji =
                $gaji->gaji_pokok +
                $gaji->tj_perumahan +
                $gaji->tj_kemahalan;
        });
    }
}
