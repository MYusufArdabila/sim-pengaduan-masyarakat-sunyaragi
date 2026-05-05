@extends('layouts.app')
@section('title', 'Profil Kelurahan')

@push('styles')
<style>
    .profil-header {
        background: linear-gradient(135deg, #1a237e, #3949ab);
        border-radius:20px; color:white; padding:2.5rem 2rem;
        margin-bottom:1.5rem; text-align:center;
    }
    .profil-logo {
        width:100px; height:100px; border-radius:20px;
        object-fit:cover; border:3px solid rgba(255,255,255,0.4);
        margin-bottom:1rem; background:rgba(255,255,255,0.1);
    }
    .profil-logo-ph {
        width:100px; height:100px; border-radius:20px;
        background:rgba(255,255,255,0.15); border:3px solid rgba(255,255,255,0.3);
        display:inline-flex; align-items:center; justify-content:center;
        font-size:2.8rem; margin-bottom:1rem;
    }
    .info-card { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .info-row { display:flex; gap:1rem; padding:.85rem 0; border-bottom:1px solid #f0f2f7; align-items:center; }
    .info-row:last-child { border-bottom:none; }
    .info-icon { width:38px; height:38px; border-radius:10px; background:#e8eaf6; display:flex; align-items:center; justify-content:center; color:#3949ab; flex-shrink:0; }
    .info-label { font-size:.72rem; color:#90a4ae; font-weight:700; text-transform:uppercase; }
    .info-val { font-size:.92rem; color:#37474f; font-weight:500; }
</style>
@endpush

@section('content')
{{-- Header Profil --}}
<div class="profil-header">
    @php $logoPath = \App\Models\Setting::get('logo_path'); @endphp
    @if($logoPath)
        <img src="{{ Storage::url($logoPath) }}" class="profil-logo" alt="Logo">
    @else
        <div class="profil-logo-ph mx-auto"><i class="bi bi-bank2"></i></div>
    @endif
    <h4 class="fw-bold mb-1">{{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }}</h4>
    <div style="opacity:.75;font-size:.9rem;">Sistem Informasi Pengaduan Masyarakat</div>
    <div style="opacity:.6;font-size:.8rem;">Kota Cirebon, Jawa Barat</div>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card info-card p-4">
            <h6 class="fw-bold mb-3">Informasi Kelurahan</h6>
            <div class="info-row">
                <div class="info-icon"><i class="bi bi-building"></i></div>
                <div>
                    <div class="info-label">Nama Kelurahan</div>
                    <div class="info-val">{{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="info-label">Alamat</div>
                    <div class="info-val">{{ \App\Models\Setting::get('alamat', '-') }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class="bi bi-telephone"></i></div>
                <div>
                    <div class="info-label">Telepon</div>
                    <div class="info-val">{{ \App\Models\Setting::get('telepon', '-') }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="info-label">Email</div>
                    <div class="info-val">{{ \App\Models\Setting::get('email_kelurahan', '-') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
