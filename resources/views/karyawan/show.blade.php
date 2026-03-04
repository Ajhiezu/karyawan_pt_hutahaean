@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('main')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Karyawan /</span> Detail Karyawan
    </h4>

    <div class="card">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nama Lengkap</div>
                <div class="col-md-8">{{ $karyawan->user->name ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">NIK</div>
                <div class="col-md-8">{{ $karyawan->nik ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Jabatan</div>
                <div class="col-md-8">{{ $karyawan->jabatan ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Pendidikan</div>
                <div class="col-md-8">{{ $karyawan->pendidikan ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Status Kerja</div>
                <div class="col-md-8">{{ $karyawan->status_kerja ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Jenis Kelamin</div>
                <div class="col-md-8">
                    {{ $karyawan->jenis_kelamin ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tanggal Lahir</div>
                <div class="col-md-8">
                    {{ $karyawan->tanggal_lahir
                    ? \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y') : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tanggal Diterima</div>
                <div class="col-md-8">
                    {{ $karyawan->tanggal_diterima
                    ? \Carbon\Carbon::parse($karyawan->tanggal_diterima)->format('d-m-Y')
                    : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Kode Status</div>
                <div class="col-md-8">{{ $karyawan->kode_status ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Alamat</div>
                <div class="col-md-8">{{ $karyawan->alamat ?? '-' }}</div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3">Informasi Gaji</h6>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Gaji Pokok</div>
                <div class="col-md-8">
                    Rp {{ number_format($karyawan->gaji->gaji_pokok ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">TJ. Perumahan</div>
                <div class="col-md-8">
                    Rp {{ number_format($karyawan->gaji->tj_perumahan ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">TJ. Kemahalan</div>
                <div class="col-md-8">
                    Rp {{ number_format($karyawan->gaji->tj_kemahalan ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold text-primary">Total Gaji</div>
                <div class="col-md-8 fw-bold text-primary">
                    Rp {{ number_format($karyawan->gaji->total_gaji ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>

        </div>
    </div>
@endsection