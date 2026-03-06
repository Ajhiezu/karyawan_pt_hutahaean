<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    protected $fillable = [
        'karyawan_id',

        'teguran_tgl',
        'teguran_no',

        'sp1_tgl',
        'sp1_no',

        'sp2_tgl',
        'sp2_no',

        'sp3_tgl',
        'sp3_no'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
