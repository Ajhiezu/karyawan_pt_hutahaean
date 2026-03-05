<?php

namespace App\Imports;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class KaryawanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Hindari import jika NIK kosong
        if (!isset($row['nik']) || empty($row['nik'])) {
            return null;
        }

        // Buat user
        $user = User::firstOrCreate(
            ['email' => $row['nik'] . '@company.com'],
            [
                'name' => $row['nama_lengkap'],
                'password' => Hash::make('password'),
                'role' => 'karyawan'
            ]
        );

        // Simpan karyawan
        $karyawan = Karyawan::updateOrCreate(
            ['nik' => $row['nik']],
            [
                'user_id' => $user->id,
                'jabatan' => strtoupper($row['jabatan']),
                'pendidikan' => $row['pendidikan'],
                'status_kerja' => strtoupper($row['status_kerja']),
                'jenis_kelamin' => strtoupper($row['jenis_kelamin']),
                'tanggal_lahir' => $this->parseTanggal($row['tanggal_lahir']),
                'tanggal_diterima' => $this->parseTanggal($row['tanggal_diterima']),
                'kode_status' => strtoupper($row['kode_status']),
                'alamat' => $row['alamat'],
                'disabilitas' => strtolower($row['disabilitas']) == 'ya',
                'masih_bekerja' => strtolower($row['masih_bekerja']) == 'ya',
                'gaji' => $row['gaji'] ?? null
            ]
        );

        // Simpan gaji
        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'gaji_pokok' => $row['gaji_pokok'] ?? 0,
            'tj_perumahan' => $row['tj_perumahan'] ?? 0,
            'tj_kemahalan' => $row['tj_kemahalan'] ?? 0,
            'total_gaji' =>
                ($row['gaji_pokok'] ?? 0) +
                ($row['tj_perumahan'] ?? 0) +
                ($row['tj_kemahalan'] ?? 0),
        ]);

        return $karyawan;
    }

    private function parseTanggal($value)
    {
        try {
            if (empty($value)) {
                return null;
            }

            // Jika numeric (Excel date serial)
            if (is_numeric($value)) {
                return Carbon::instance(
                    Date::excelToDateTimeObject($value)
                )->format('Y-m-d');
            }

            // Bersihkan spasi
            $value = trim($value);

            // Coba auto parse semua format
            return Carbon::parse($value)->format('Y-m-d');

        } catch (\Exception $e) {
            return null;
        }
    }
}
