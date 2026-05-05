@extends('layouts.app')
@section('title', 'Buat Pengaduan')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    #map { height: 300px; border-radius: 12px; border: 1.5px solid #e0e3ea; }
    .form-label { font-size: .85rem; font-weight: 600; color: #37474f; }
    .form-control, .form-select { border-radius: 10px; border: 1.5px solid #e0e3ea; }
    .form-control:focus, .form-select:focus { border-color: #3949ab; box-shadow: 0 0 0 3px rgba(57,73,171,0.1); }
    .section-card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .map-hint { background:#e8eaf6; border-radius:8px; padding:.6rem .9rem; font-size:.8rem; color:#3949ab; }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-light border">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="fw-bold mb-0">Ajukan Pengaduan Baru</h5>
        </div>

        <div class="card section-card">
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori Pengaduan</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Pilih Kategori (Opsional) --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="Contoh: Jalan Berlubang di RT 05 RW 02" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="4" placeholder="Jelaskan masalah secara detail..." required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Bukti <small class="text-muted">(Opsional, maks. 2MB)</small></label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                            accept="image/*">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Lokasi --}}
                    <hr class="my-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Lokasi Kejadian</h6>

                    <div class="mb-3">
                        <label class="form-label">Alamat / Nama Lokasi</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ old('location') }}"
                            placeholder="Contoh: Jl. Sunyaragi No. 10, RT 01/RW 02">
                    </div>

                    <div class="map-hint mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Titik koordinat disesuaikan otomatis dengan lokasi Anda saat ini dan tidak dapat diubah secara manual.
                    </div>

                    <div id="map" class="mb-3"></div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control"
                                value="{{ old('latitude') }}" placeholder="-6.7320" readonly>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control"
                                value="{{ old('longitude') }}" placeholder="108.5520" readonly>
                        </div>
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="useMyLocation()">
                            <i class="bi bi-crosshair me-1"></i>Perbarui Lokasi Saya
                        </button>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('complaints.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send me-2"></i>Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const defaultLat = {{ old('latitude', -6.7320) }};
    const defaultLng = {{ old('longitude', 108.5520) }};

    const map = L.map('map').setView([defaultLat, defaultLng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker = null;

    @if(old('latitude') && old('longitude'))
    marker = L.marker([defaultLat, defaultLng]).addTo(map);
    @endif

    function useMyLocation() {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung browser ini.');
            return;
        }
        navigator.geolocation.getCurrentPosition(function(pos) {
            const lat = pos.coords.latitude.toFixed(6);
            const lng = pos.coords.longitude.toFixed(6);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            map.setView([lat, lng], 16);
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
        }, function() { 
            alert('Akses lokasi ditolak atau gagal didapatkan. Silakan klik pada peta secara manual untuk menentukan lokasi.'); 
        });
    }

    // Auto-load location if no previous coordinate exists
    @if(!old('latitude') && !old('longitude'))
    document.addEventListener('DOMContentLoaded', function() {
        useMyLocation();
    });
    @endif
</script>
@endpush
