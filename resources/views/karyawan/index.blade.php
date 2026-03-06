@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('main')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Karyawan /</span> Data Karyawan
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <!-- Form Search -->
            <form action="{{ route('karyawan.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <button type="submit" class="input-group-text">
                        <i class="bx bx-search-alt"></i>
                    </button>
                    <input type="text" name="search" class="form-control" placeholder="Cari NIK dan Nama..."
                        value="{{ request('search') }}" autocomplete="off">
                </div>
            </form>

            <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Karyawan
            </a>

            <form action="/import-karyawan" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit">Import</button>
            </form>

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawans as $index => $karyawan)
                        <tr>
                            <td>{{ $karyawans->firstItem() + $index }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if ($karyawan->gambar)
                                            <img src="{{ asset('uploads/karyawan/' . $karyawan->gambar) }}" class="rounded"
                                                width="32" height="32">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($karyawan->user->name) }}&background=random&color=fff"
                                                class="rounded" width="32" height="32">
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>{{ $karyawan->user->name }}</td>
                            <td>{{ $karyawan->nik }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('karyawan.show', $karyawan->id) }}" class="btn btn-sm btn-secondary">
                                        <i class="bx bx-show"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-secondary">
                                        <i class="bx bx-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form id="delete-form-{{ $karyawan->id }}"
                                        action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <button type="button" onclick="deleteKaryawan({{ $karyawan->id }})"
                                        class="btn btn-sm btn-secondary">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="19" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="m-3">
            {{ $karyawans->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        function deleteKaryawan(id) {
            Swal.fire({
                title: 'Yakin?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
