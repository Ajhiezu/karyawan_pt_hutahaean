<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nik',
        'jabatan',
        'pendidikan',
        'status_kerja',
        'jenis_kelamin',
        'tanggal_lahir',
        'tanggal_diterima',
        'kode_status',
        'alamat',
        'disabilitas',
        'masih_bekerja',
        'gaji'
    ];

    protected $casts = [
        'disabilitas' => 'boolean',
        'masih_bekerja' => 'boolean',
        'tanggal_lahir' => 'date',
        'tanggal_diterima' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gaji()
    {
        return $this->hasOne(Gaji::class);
    }
}
