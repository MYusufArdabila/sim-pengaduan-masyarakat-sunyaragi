@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-light border"><i class="bi bi-arrow-left"></i></a>
            <h5 class="fw-bold mb-0">Edit Pengguna</h5>
        </div>
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 mb-3">
                        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3"
                            value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-3"
                            value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru <small class="text-muted fw-normal">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control rounded-3"
                            placeholder="Minimal 6 karakter">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select rounded-3" required>
                            <option value="admin"  {{ old('role', $user->role) === 'admin'  ? 'selected' : '' }}>Admin Kelurahan</option>
                            <option value="warga"  {{ old('role', $user->role) === 'warga'  ? 'selected' : '' }}>Warga</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
