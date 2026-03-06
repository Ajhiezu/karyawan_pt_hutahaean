@extends('layouts.app')

@section('title', 'Form Karyawan')

@section('main')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Karyawan /</span>
        {{ isset($karyawan) ? 'Edit Karyawan' : 'Tambah Karyawan' }}
    </h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($karyawan) ? route('karyawan.update', $karyawan->id) : route('karyawan.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($karyawan)
                    @method('PUT')
                @endisset

                {{-- DATA USER --}}
                <h6 class="mb-3 text-primary">Data Akun</h6>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar Profile</label>
                    <!-- Input File -->
                    <input type="file" name="gambar" id="gambarInput" class="form-control">

                    <!-- Preview -->
                    <img id="previewImage"
                        src="{{ isset($karyawan) && $karyawan->gambar ? asset('uploads/karyawan/' . $karyawan->gambar) : '' }}"
                        alt="Preview Gambar" class="mt-2"
                        style="max-width: 500px; {{ isset($karyawan) && $karyawan->gambar ? '' : 'display:none;' }}">
                </div>

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
                    <input type="text" name="nik" class="form-control" value="{{ old('nik', $karyawan->nik ?? '') }}"
                        required autocomplete="off">
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
                        value="{{ old(
                            'tanggal_diterima',
                            isset($karyawan) && $karyawan->tanggal_diterima ? $karyawan->tanggal_diterima->format('Y-m-d') : '',
                        ) }}"
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
                        <input type="checkbox" name="disabilitas" value="1" class="form-check-input"
                            {{ old('disabilitas', $karyawan->disabilitas ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label">Disabilitas</label>
                    </div>
                </div>

                @isset($karyawan)
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="masih_bekerja" value="1" class="form-check-input"
                                {{ old('masih_bekerja', $karyawan->masih_bekerja ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label">Masih Bekerja</label>
                        </div>
                    </div>
                @endisset

                <hr>

                <div class="row">

                    <h6 class="mb-3 text-primary">Gaji</h6>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="text" name="gaji_pokok" class="form-control rupiah gaji"
                            value="{{ old('gaji_pokok', isset($karyawan->gaji) ? (int) $karyawan->gaji->gaji_pokok : 0) }}"
                            required autocomplete="off">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tunjangan Perumahan</label>
                        <input type="text" name="tj_perumahan" class="form-control rupiah gaji"
                            value="{{ old('tj_perumahan', isset($karyawan->gaji) ? (int) $karyawan->gaji->tj_perumahan : 0) }}"
                            autocomplete="off">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tunjangan Kemahalan</label>
                        <input type="text" name="tj_kemahalan" class="form-control rupiah gaji"
                            value="{{ old('tj_kemahalan', isset($karyawan->gaji) ? (int) $karyawan->gaji->tj_kemahalan : 0) }}"
                            autocomplete="off">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Total Gaji</label>
                        <input type="text" id="total_gaji" class="form-control rupiah"
                            value="{{ old('total_gaji', isset($karyawan->gaji) ? (int) $karyawan->gaji->total_gaji : 0) }}"
                            readonly>
                    </div>
                </div>

                <hr>
                <h6 class="mb-3 text-primary">Cuti</h6>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Periode Cuti</label>
                        <input type="text" name="periode_cuti" class="form-control" placeholder="Contoh: 2025/2026"
                            value="{{ old('periode_cuti', $karyawan->cuti->periode_cuti ?? '') }}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Hak Cuti</label>
                        <input type="number" name="hak_cuti" id="hak_cuti" class="form-control cuti"
                            value="{{ old('hak_cuti', $karyawan->cuti->hak_cuti ?? 12) }}" readonly>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Cuti Dijalani</label>
                        <input type="number" name="cuti_dijalani" id="cuti_dijalani" class="form-control cuti"
                            value="{{ old('cuti_dijalani', $karyawan->cuti->cuti_dijalani ?? 0) }}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Cuti Diusulkan</label>
                        <input type="number" name="cuti_diusulkan" id="cuti_diusulkan" class="form-control cuti"
                            value="{{ old('cuti_diusulkan', $karyawan->cuti->cuti_diusulkan ?? 0) }}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-bold">Sisa Cuti</label>
                        <input type="number" name="sisa_cuti" id="sisa_cuti" class="form-control"
                            value="{{ old('sisa_cuti', $karyawan->cuti->sisa_cuti ?? 12) }}" readonly>
                    </div>

                </div>

                <hr>
                <hr>
                <h6 class="mb-3 text-primary">Punishment</h6>

                {{-- SURAT TEGURAN --}}
                <div class="mb-4">
                    <label class="fw-bold mb-2">Surat Teguran</label>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Surat Teguran</label>
                            <input type="date" name="teguran_tgl" class="form-control"
                                value="{{ old('teguran_tgl', $karyawan->punishment->teguran_tgl ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Surat Teguran</label>
                            <input type="text" name="teguran_no" class="form-control"
                                value="{{ old('teguran_no', $karyawan->punishment->teguran_no ?? '') }}">
                        </div>

                    </div>
                </div>


                {{-- SP I, II, III --}}
                <label class="fw-bold mb-2">Surat Peringatan (SP)</label>

                <div class="row">

                    {{-- SP 1 --}}
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-center fw-bold">SP I</h6>

                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="sp1_tgl" class="form-control"
                                    value="{{ old('sp1_tgl', $karyawan->punishment->sp1_tgl ?? '') }}">
                            </div>

                            <div>
                                <label class="form-label">Nomor</label>
                                <input type="text" name="sp1_no" class="form-control"
                                    value="{{ old('sp1_no', $karyawan->punishment->sp1_no ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- SP 2 --}}
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-center fw-bold">SP II</h6>

                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="sp2_tgl" class="form-control"
                                    value="{{ old('sp2_tgl', $karyawan->punishment->sp2_tgl ?? '') }}">
                            </div>

                            <div>
                                <label class="form-label">Nomor</label>
                                <input type="text" name="sp2_no" class="form-control"
                                    value="{{ old('sp2_no', $karyawan->punishment->sp2_no ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- SP 3 --}}
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-center fw-bold">SP III</h6>

                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="sp3_tgl" class="form-control"
                                    value="{{ old('sp3_tgl', $karyawan->punishment->sp3_tgl ?? '') }}">
                            </div>

                            <div>
                                <label class="form-label">Nomor</label>
                                <input type="text" name="sp3_no" class="form-control"
                                    value="{{ old('sp3_no', $karyawan->punishment->sp3_no ?? '') }}">
                            </div>
                        </div>
                    </div>

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

    <script>
        document.getElementById('gambarInput').addEventListener('change', function(event) {
            let preview = document.getElementById('previewImage');
            let file = event.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>

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

        function angkaBersih(value) {
            return parseInt(value.replace(/\./g, '').replace(/,/g, '')) || 0;
        }

        function hitungTotalGaji() {

            let gajiPokok = angkaBersih(document.querySelector('[name="gaji_pokok"]').value);
            let tjPerumahan = angkaBersih(document.querySelector('[name="tj_perumahan"]').value);
            let tjKemahalan = angkaBersih(document.querySelector('[name="tj_kemahalan"]').value);

            let total = gajiPokok + tjPerumahan + tjKemahalan;

            document.getElementById('total_gaji').value =
                new Intl.NumberFormat('id-ID').format(total);
        }

        document.querySelectorAll('.gaji').forEach(function(input) {
            input.addEventListener('input', hitungTotalGaji);
        });

        hitungTotalGaji();

        function hitungSisaCuti() {

            let hak = parseInt(document.getElementById('hak_cuti').value) || 0;
            let dijalani = parseInt(document.getElementById('cuti_dijalani').value) || 0;
            let diusulkan = parseInt(document.getElementById('cuti_diusulkan').value) || 0;

            let sisa = hak - dijalani - diusulkan;

            if (sisa < 0) {
                sisa = 0;
            }

            document.getElementById('sisa_cuti').value = sisa;

        }

        document.querySelectorAll('.cuti').forEach(function(input) {
            input.addEventListener('input', hitungSisaCuti);
        });

        hitungSisaCuti();
    </script>

@endpush
