@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('main')
    <style>
        .avatar-xl img {
            border: 3px solid #696cff;
        }
    </style>
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Karyawan /</span> Data Diri
    </h4>

    <div class="card">
        <div class="card-body">

            <div class="mb-4">
                <img src="{{ $karyawan->gambar
                    ? asset('uploads/karyawan/' . $karyawan->gambar)
                    : 'https://ui-avatars.com/api/?name=' .
                        urlencode($karyawan->user->name ?? 'User') .
                        '&background=random&color=fff&size=100' }}"
                    class="rounded shadow" width="120" height="120">
            </div>

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
                    {{ $karyawan->tanggal_lahir ? \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y') : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tanggal Diterima</div>
                <div class="col-md-8">
                    {{ $karyawan->tanggal_diterima ? \Carbon\Carbon::parse($karyawan->tanggal_diterima)->format('d-m-Y') : '-' }}
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

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="fw-bold">Gaji Pokok</div>
                    <div>
                        Rp {{ number_format($karyawan->gaji->gaji_pokok ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fw-bold">Tunjangan Perumahan</div>
                    <div>
                        Rp {{ number_format($karyawan->gaji->tj_perumahan ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fw-bold">Tunjangan Kemahalan</div>
                    <div>
                        Rp {{ number_format($karyawan->gaji->tj_kemahalan ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            @php
                $total_gaji =
                    ($karyawan->gaji->gaji_pokok ?? 0) +
                    ($karyawan->gaji->tj_perumahan ?? 0) +
                    ($karyawan->gaji->tj_kemahalan ?? 0);
            @endphp

            <div class="col-md-4">
                <div class="fw-bold">Total Gaji</div>
                <div>
                    Rp {{ number_format($karyawan->gaji->total_gaji ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <hr>
            <h6 class="fw-bold mb-3">CUTI</h6>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Periode Cuti</div>
                <div class="col-md-8">
                    {{ $karyawan->cuti->periode_cuti ?? '-' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Hak Cuti</div>
                <div class="col-md-8">
                    {{ $karyawan->cuti->hak_cuti ?? 12 }} HK
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Cuti Dijalani</div>
                <div class="col-md-8">
                    {{ $karyawan->cuti->cuti_dijalani ?? 0 }} HK
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Cuti Diusulkan</div>
                <div class="col-md-8">
                    {{ $karyawan->cuti->cuti_diusulkan ?? 0 }} HK
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Sisa Cuti</div>
                <div class="col-md-8">
                    {{ $karyawan->cuti->sisa_cuti ?? 12 }} HK
                </div>
            </div>

            <hr>
            <h6 class="fw-bold mb-3">PUNISHMENT</h6>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Surat Teguran</div>
                <div class="col-md-8">
                    @if (optional($karyawan->punishment)->teguran_tgl || optional($karyawan->punishment)->teguran_no)
                        {{ $karyawan->punishment->teguran_tgl ?? '-' }}
                        |
                        {{ $karyawan->punishment->teguran_no ?? '-' }}
                    @else
                        <span class="text-muted">Tidak ada data</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Surat Peringatan I</div>
                <div class="col-md-8">
                    @if (optional($karyawan->punishment)->sp1_tgl || optional($karyawan->punishment)->sp1_no)
                        {{ $karyawan->punishment->sp1_tgl ?? '-' }}
                        |
                        {{ $karyawan->punishment->sp1_no ?? '-' }}
                    @else
                        <span class="text-muted">Tidak ada data</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Surat Peringatan II</div>
                <div class="col-md-8">
                    @if (optional($karyawan->punishment)->sp2_tgl || optional($karyawan->punishment)->sp2_no)
                        {{ $karyawan->punishment->sp2_tgl ?? '-' }}
                        |
                        {{ $karyawan->punishment->sp2_no ?? '-' }}
                    @else
                        <span class="text-muted">Tidak ada data</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Surat Peringatan III</div>
                <div class="col-md-8">
                    @if (optional($karyawan->punishment)->sp3_tgl || optional($karyawan->punishment)->sp3_no)
                        {{ $karyawan->punishment->sp3_tgl ?? '-' }}
                        |
                        {{ $karyawan->punishment->sp3_no ?? '-' }}
                    @else
                        <span class="text-muted">Tidak ada data</span>
                    @endif
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
