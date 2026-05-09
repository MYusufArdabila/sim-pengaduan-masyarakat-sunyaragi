@extends('layouts.app')
@section('title', 'Ubah Password')

@push('styles')
<style>
    .settings-card { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .form-label { font-size:.85rem; font-weight:600; color:#37474f; }
    .form-control { border-radius:10px; border:1.5px solid #e0e3ea; padding:.65rem 1rem; }
    .form-control:focus { border-color:#3949ab; box-shadow:0 0 0 3px rgba(57,73,171,0.1); }
    .btn-save { background:#1a5fcb; color:#fff; border:none; padding:.75rem 1.5rem; font-weight:600; border-radius:10px; transition:all .2s; }
    .btn-save:hover { background:#1044a8; transform:translateY(-1px); box-shadow:0 5px 15px rgba(26,95,203,0.3); }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card settings-card p-4">
            <h5 class="fw-bold mb-4"><i class="bi bi-key me-2 text-primary"></i>Ubah Password</h5>
            
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="old_password" class="form-label">Password Lama <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0 @error('old_password') is-invalid @enderror" 
                               id="old_password" name="old_password" required placeholder="Masukkan password lama">
                        @error('old_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                               id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check text-muted"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0" 
                               id="password_confirmation" name="password_confirmation" required placeholder="Ketik ulang password baru">
                    </div>
                </div>

                <button type="submit" class="btn btn-save w-100">
                    <i class="bi bi-check2-circle me-2"></i>Simpan Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
