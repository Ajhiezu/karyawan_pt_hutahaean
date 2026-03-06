<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $fillable = [
        'karyawan_id',
        'periode_cuti',
        'hak_cuti',
        'cuti_dijalani',
        'cuti_diusulkan',
        'sisa_cuti'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
