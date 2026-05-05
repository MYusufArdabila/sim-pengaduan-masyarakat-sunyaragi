@extends('layouts.app')
@section('title', 'Tambah Kategori')

@push('styles')
<style>
    .card-premium { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .form-label { font-size: .85rem; font-weight: 600; color: #37474f; }
    .form-control { border-radius: 10px; border: 1.5px solid #e0e3ea; }
    .form-control:focus { border-color: #3949ab; box-shadow: 0 0 0 3px rgba(57,73,171,0.1); }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light border rounded-circle" style="width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="fw-bold mb-0">Tambah Kategori Baru</h5>
        </div>

        <div class="card card-premium">
            <div class="card-body p-4">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Infrastruktur" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Penjelasan singkat kategori..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-light border px-4 rounded-pill">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-save me-2"></i>Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
