@extends('layouts.app')
@section('title', 'Pengaturan')

@push('styles')
<style>
    .settings-card { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .form-label { font-size:.85rem; font-weight:600; color:#37474f; }
    .form-control { border-radius:10px; border:1.5px solid #e0e3ea; }
    .form-control:focus { border-color:#3949ab; box-shadow:0 0 0 3px rgba(57,73,171,0.1); }
    .logo-preview { width:120px; height:120px; border-radius:16px; object-fit:cover; border:2px solid #e0e3ea; }
    .logo-placeholder-box {
        width:120px; height:120px; border-radius:16px;
        background:#f0f2f7; border:2px dashed #cfd8dc;
        display:flex; align-items:center; justify-content:center;
        font-size:2.5rem; color:#90a4ae;
    }
</style>
@endpush

@section('content')
<h5 class="fw-bold mb-4"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan Aplikasi</h5>

<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        {{-- Logo --}}
        <div class="col-lg-4">
            <div class="card settings-card p-4 h-100">
                <h6 class="fw-bold mb-3">Logo Kelurahan</h6>
                <div class="mb-3 text-center">
                    <img src="{{ asset('images/logo_sunyaragi.jpeg') }}" class="logo-preview" id="logoPreview" alt="Logo">
                </div>
                <div class="mb-3">
                    <label class="form-label">Unggah Logo Baru</label>
                    <input type="file" name="logo" class="form-control" accept="image/*" id="logoInput"
                        onchange="previewLogo(this)">
                    <small class="text-muted">Format: JPG, PNG. Maks. 2MB. Rekomendasi: 200×200px.</small>
                </div>
            </div>
        </div>

        {{-- Profil --}}
        <div class="col-lg-8">
            <div class="card settings-card p-4">
                <h6 class="fw-bold mb-3">Profil Kelurahan</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Kelurahan</label>
                        <input type="text" name="nama_kelurahan" class="form-control"
                            value="{{ \App\Models\Setting::get('nama_kelurahan') }}"
                            placeholder="Kelurahan Sunyaragi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                            value="{{ \App\Models\Setting::get('telepon') }}"
                            placeholder="(0231) 123456">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="2"
                            placeholder="Jl. Sunyaragi No. 1, Kota Cirebon">{{ \App\Models\Setting::get('alamat') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Kelurahan</label>
                        <input type="email" name="email_kelurahan" class="form-control"
                            value="{{ \App\Models\Setting::get('email_kelurahan') }}"
                            placeholder="kelurahan@cirebonkota.go.id">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary px-5 rounded-pill">
                <i class="bi bi-save me-2"></i>Simpan Pengaturan
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('logoPreview');
            const ph  = document.getElementById('logoPlaceholder');
            img.src = e.target.result;
            img.classList.remove('d-none');
            img.classList.add('mx-auto', 'd-block');
            if (ph) ph.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
