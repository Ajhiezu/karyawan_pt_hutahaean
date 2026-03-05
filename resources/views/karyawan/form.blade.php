@extends('layouts.app')

@section('title', 'Form Karyawan')

@section('main')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Karyawan /</span>
    {{ isset($karyawan) ? 'Edit Karyawan' : 'Tambah Karyawan' }}
</h4>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($karyawan) ? route('karyawan.update',$karyawan->id) : route('karyawan.store') }}"
              method="POST">
            @csrf
            @isset($karyawan)
                @method('PUT')
            @endisset

            {{-- DATA USER --}}
            <h6 class="mb-3 text-primary">Data Akun</h6>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $karyawan->user->name ?? '') }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $karyawan->user->email ?? '') }}" required autocomplete="off">
            </div>

            <hr>

            {{-- DATA KARYAWAN --}}
            <h6 class="mb-3 text-primary">Data Karyawan</h6>

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control"
                    value="{{ old('nik', $karyawan->nik ?? '') }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control"
                    value="{{ old('jabatan', $karyawan->jabatan ?? '') }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan</label>
                <input type="text" name="pendidikan" class="form-control"
                    value="{{ old('pendidikan', $karyawan->pendidikan ?? '') }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label class="form-label">Status Kerja</label>
                <select name="status_kerja" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="PERMANEN"
                        {{ old('status_kerja', $karyawan->status_kerja ?? '') == 'PERMANEN' ? 'selected' : '' }}>
                        PERMANEN
                    </option>
                    <option value="PKWT"
                        {{ old('status_kerja', $karyawan->status_kerja ?? '') == 'PKWT' ? 'selected' : '' }}>
                        PKWT
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="LAKI LAKI"
                        {{ old('jenis_kelamin', $karyawan->jenis_kelamin ?? '') == 'LAKI LAKI' ? 'selected' : '' }}>
                        LAKI LAKI
                    </option>
                    <option value="PEREMPUAN"
                        {{ old('jenis_kelamin', $karyawan->jenis_kelamin ?? '') == 'PEREMPUAN' ? 'selected' : '' }}>
                        PEREMPUAN
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                    value="{{ old('tanggal_lahir', isset($karyawan) && $karyawan->tanggal_lahir ? $karyawan->tanggal_lahir->format('Y-m-d') : '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Diterima</label>
                <input type="date" name="tanggal_diterima" class="form-control"
                    value="{{ old('tanggal_diterima', isset($karyawan) && $karyawan->tanggal_diterima 
                    ? $karyawan->tanggal_diterima->format('Y-m-d') 
                    : '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Status</label>
                <input type="text" name="kode_status" class="form-control"
                    value="{{ old('kode_status', $karyawan->kode_status ?? '') }}" autocomplete="off">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $karyawan->alamat ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="disabilitas" value="1"
                        class="form-check-input"
                        {{ old('disabilitas', $karyawan->disabilitas ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">Disabilitas</label>
                </div>
            </div>

            @isset($karyawan)
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="masih_bekerja" value="1"
                        class="form-check-input"
                        {{ old('masih_bekerja', $karyawan->masih_bekerja ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label">Masih Bekerja</label>
                </div>
            </div>
            @endisset

            <hr>

            <h6 class="mb-3 text-primary">Data Gaji</h6>

            <div class="mb-3">
                <label class="form-label">Gaji</label>
                <select name="gaji" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="gaji_pokok"
                        {{ old('gaji', $karyawan->gaji ?? '') == 'gaji_pokok' ? 'selected' : '' }}>
                        Gaji Pokok
                    </option>
                    <option value="tj_perumahan"
                        {{ old('gaji', $karyawan->gaji ?? '') == 'tj_perumahan' ? 'selected' : '' }}>
                        Tunjangan Perumahan
                    </option>
                    <option value="tj_kemahalan"
                        {{ old('gaji', $karyawan->gaji ?? '') == 'tj_kemahalan' ? 'selected' : '' }}>
                        Tunjangan Kemahalan
                    </option>
                </select>
            </div>

            <button class="btn btn-primary">
                {{ isset($karyawan) ? 'Update' : 'Simpan' }}
            </button>

            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            })
        </script>
    @endif

    <script>
document.querySelectorAll('.rupiah').forEach(function(input) {

    if (input.value) {
        let clean = input.value.replace(/\D/g, '');
        input.value = new Intl.NumberFormat('id-ID').format(clean);
    }

    input.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = new Intl.NumberFormat('id-ID').format(value);
    });

    input.closest('form').addEventListener('submit', function() {
        input.value = input.value.replace(/\./g, '');
    });

});
</script>
@endpush