<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Karyawan::with(['user', 'gaji'])->orderBy('created_at', 'desc');

        if ($request->search) {
            $query->where('nik', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        $karyawans = $query->paginate(10)->withQueryString();

        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',

            'nik' => 'required|unique:karyawans,nik',
            'jabatan' => 'required|string',
            'pendidikan' => 'required|string',
            'status_kerja' => 'required|in:PERMANEN,PKWT',
            'jenis_kelamin' => 'required|in:LAKI LAKI,PEREMPUAN',
            'tanggal_lahir' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'alamat' => 'required|string',
            'gaji_pokok' => 'required|numeric|min:0',
            'tj_perumahan' => 'nullable|numeric|min:0',
            'tj_kemahalan' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'role' => 'karyawan'
            ]);

            $karyawan = Karyawan::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'jabatan' => $request->jabatan,
                'pendidikan' => $request->pendidikan,
                'status_kerja' => $request->status_kerja,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tanggal_diterima' => $request->tanggal_diterima,
                'kode_status' => $request->kode_status,
                'alamat' => $request->alamat,
                'disabilitas' => $request->disabilitas ?? false,
                'masih_bekerja' => true,
            ]);

            $total =
                $request->gaji_pokok +
                ($request->tj_perumahan ?? 0) +
                ($request->tj_kemahalan ?? 0);

            Gaji::create([
                'karyawan_id' => $karyawan->id,
                'gaji_pokok' => $request->gaji_pokok,
                'tj_perumahan' => $request->tj_perumahan ?? 0,
                'tj_kemahalan' => $request->tj_kemahalan ?? 0,
                'total_gaji' => $total,
            ]);
        });

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        $karyawan->load('user');
        return view('karyawan.form', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $karyawan->user_id,

            'nik' => 'required|unique:karyawans,nik,' . $karyawan->id,
            'jabatan' => 'required|string',
            'pendidikan' => 'required|string',
            'status_kerja' => 'required|in:PERMANEN,PKWT',
            'jenis_kelamin' => 'required|in:LAKI LAKI,PEREMPUAN',
            'tanggal_lahir' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'alamat' => 'required|string',
            'gaji_pokok' => 'required|numeric|min:0',
            'tj_perumahan' => 'nullable|numeric|min:0',
            'tj_kemahalan' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $karyawan) {

            $karyawan->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $karyawan->update([
                'nik' => $request->nik,
                'jabatan' => $request->jabatan,
                'pendidikan' => $request->pendidikan,
                'status_kerja' => $request->status_kerja,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tanggal_diterima' => $request->tanggal_diterima,
                'kode_status' => $request->kode_status,
                'alamat' => $request->alamat,
                'disabilitas' => $request->disabilitas ?? false,
                'masih_bekerja' => $request->masih_bekerja ?? true,
            ]);

            $total =
                $request->gaji_pokok +
                ($request->tj_perumahan ?? 0) +
                ($request->tj_kemahalan ?? 0);

            $karyawan->gaji()->updateOrCreate(
                ['karyawan_id' => $karyawan->id],
                [
                    'gaji_pokok' => $request->gaji_pokok,
                    'tj_perumahan' => $request->tj_perumahan ?? 0,
                    'tj_kemahalan' => $request->tj_kemahalan ?? 0,
                    'total_gaji' => $total,
                ]
            );
        });

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        DB::transaction(function () use ($karyawan) {
            $karyawan->delete();
            $karyawan->user->delete();
        });

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus');
    }
}
