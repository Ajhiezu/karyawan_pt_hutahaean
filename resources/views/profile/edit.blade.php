@extends('layouts.app')

@section('title', 'Profile')

@section('main')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account /</span> Profile
    </h4>

    <div class="row">

        {{-- ================= PROFILE INFORMATION ================= --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                    <small class="text-muted">
                        Update your account name and email address.
                    </small>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                class="form-control" required autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                class="form-control" required autocomplete="off">
                        </div>

                        <button class="btn btn-primary">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>


        {{-- ================= UPDATE PASSWORD ================= --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Update Password</h5>
                    <small class="text-muted">
                        Use a strong password to keep your account secure.
                    </small>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button class="btn btn-warning">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>


        {{-- ================= DELETE ACCOUNT ================= --}}
        <div class="col-md-12">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Delete Account
                </div>

                <div class="card-body">
                    <p class="text-muted">
                        Once your account is deleted, all data will be permanently removed.
                    </p>

                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>

    </div>


    {{-- ================= DELETE MODAL ================= --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>Please enter your password to confirm deletion.</p>

                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-danger">
                            Delete Permanently
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('status') === 'profile-updated')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated',
                text: 'Your profile has been updated successfully.',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('status') === 'password-updated')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Password Updated',
                text: 'Your password has been updated successfully.',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('status') === 'account-deleted')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Account Deleted',
                text: 'Your account has been deleted.',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
@endpush