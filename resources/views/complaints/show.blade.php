@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
    .detail-card { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .info-label { font-size:.75rem; text-transform:uppercase; letter-spacing:.06em; color:#90a4ae; font-weight:700; margin-bottom:.25rem; }
    .info-value { font-size:.92rem; color:#37474f; font-weight:500; }
    #detail-map { height:220px; border-radius:12px; border:1.5px solid #e0e3ea; }
    .response-bubble {
        padding:.85rem 1rem; border-radius:12px; margin-bottom:.75rem;
        border: 1px solid #eee;
    }
    .response-bubble.admin-reply { background:#e8eaf6; border-color:#c5cae9; }
    .response-bubble.warga-reply { background:#f9f9f9; }
    .file-download-box {
        background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
        border: 1.5px solid #a5d6a7; border-radius:12px; padding:1rem 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-light border">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h5 class="fw-bold mb-0">Detail Pengaduan</h5>
</div>

<div class="row g-3">
    {{-- Kolom Kiri: Info Pengaduan --}}
    <div class="col-lg-7">
        <div class="card detail-card mb-3">
            <div class="card-body p-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                    @if($complaint->category)
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-normal px-3 py-2">
                            {{ $complaint->category->name }}
                        </span>
                    @endif
                    @if($complaint->status === 'Menunggu')
                        <span class="badge rounded-pill px-3 py-2" style="background:#fff3e0;color:#e65100;font-size:.8rem;">⏳ Menunggu</span>
                    @elseif($complaint->status === 'Diproses')
                        <span class="badge rounded-pill px-3 py-2" style="background:#e0f2f1;color:#00695c;font-size:.8rem;">⚙️ Sedang Diproses</span>
                    @else
                        <span class="badge rounded-pill px-3 py-2" style="background:#e8f5e9;color:#1b5e20;font-size:.8rem;">✅ Selesai</span>
                    @endif
                </div>

                <h5 class="fw-bold mb-3">{{ $complaint->title }}</h5>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="info-label">Pelapor</div>
                        <div class="info-value">
                            <i class="bi bi-person-circle me-1 text-muted"></i>
                            @if(Auth::user()->role === 'admin')
                                Warga Anonim <small class="text-muted">(ID: {{ $complaint->user_id }})</small>
                            @else
                                Warga Anonim
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Tanggal Laporan</div>
                        <div class="info-value">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $complaint->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>

                <div class="info-label">Deskripsi</div>
                <p class="mb-4" style="white-space:pre-wrap;font-size:.9rem;line-height:1.7;">{{ $complaint->description }}</p>

                {{-- Foto Bukti --}}
                @if($complaint->photo)
                <div class="mb-4">
                    <div class="info-label mb-2">Foto Bukti</div>
                    <img src="{{ Storage::url($complaint->photo) }}"
                        class="img-fluid rounded-3 shadow-sm"
                        style="max-height:350px; cursor:pointer;"
                        onclick="window.open(this.src)"
                        alt="Foto pengaduan">
                </div>
                @endif

                {{-- File Selesai --}}
                @if($complaint->finished_file)
                <div class="file-download-box mb-4">
                    <div class="info-label mb-1">Dokumen Penyelesaian</div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-check-fill text-success fs-4"></i>
                        <div class="flex-grow-1">
                            <div class="fw-semibold small">File dokumen tersedia</div>
                            <div class="text-muted" style="font-size:.75rem;">Diunggah oleh Admin Kelurahan</div>
                        </div>
                        <a href="{{ Storage::url($complaint->finished_file) }}"
                            target="_blank" download
                            class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="bi bi-download me-1"></i>Unduh
                        </a>
                    </div>
                </div>
                @endif

                {{-- Lokasi --}}
                @if($complaint->location || $complaint->latitude)
                <div class="mb-3">
                    <div class="info-label mb-2">Lokasi Kejadian</div>
                    @if($complaint->location)
                        <div class="info-value mb-2">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $complaint->location }}
                        </div>
                    @endif
                    @if($complaint->latitude)
                        <div class="text-muted small mb-2">
                            Koordinat: {{ $complaint->latitude }}, {{ $complaint->longitude }}
                        </div>
                        <div id="detail-map"></div>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Update Status (Admin) --}}
        @if(Auth::user()->role === 'admin')
        <div class="card detail-card mb-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-sliders me-2 text-primary"></i>Ubah Status Pengaduan</h6>
                <form action="{{ route('complaints.updateStatus', $complaint->id) }}" method="POST" class="d-flex gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select rounded-pill">
                        <option value="Menunggu" {{ $complaint->status === 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                        <option value="Diproses" {{ $complaint->status === 'Diproses' ? 'selected' : '' }}>⚙️ Diproses</option>
                        <option value="Selesai"  {{ $complaint->status === 'Selesai'  ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                </form>
            </div>
        </div>

        {{-- Upload File Selesai (Admin) --}}
        <div class="card detail-card mb-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-1"><i class="bi bi-upload me-2 text-success"></i>Upload Dokumen Penyelesaian</h6>
                <p class="text-muted small mb-3">File ini dapat diunduh oleh warga pelapor. Format: PDF, JPG, PNG, DOC (maks. 5MB).</p>
                <form action="{{ route('complaints.uploadFile', $complaint->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="finished_file" class="form-control rounded-start"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                        <button type="submit" class="btn btn-success rounded-end px-3">
                            <i class="bi bi-upload me-1"></i>Upload
                        </button>
                    </div>
                    @error('finished_file')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
        @endif
    </div>

    {{-- Kolom Kanan: Tanggapan --}}
    <div class="col-lg-5">
        <div class="card detail-card h-auto">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h6 class="fw-bold"><i class="bi bi-chat-dots me-2 text-primary"></i>Tanggapan Admin</h6>
            </div>
            <div class="card-body">
                @if($complaint->responses->isEmpty())
                    <div class="text-center py-4">
                        <i class="bi bi-chat-square-text d-block mb-2" style="font-size:2.5rem;color:#cfd8dc;"></i>
                        <p class="text-muted small">Belum ada tanggapan dari admin.</p>
                    </div>
                @else
                    @foreach($complaint->responses as $resp)
                    <div class="response-bubble {{ $resp->user->role === 'admin' ? 'admin-reply' : 'warga-reply' }}">
                        <div class="d-flex justify-content-between mb-1">
                            <strong class="small {{ $resp->user->role === 'admin' ? 'text-primary' : '' }}">
                                @if($resp->user->role === 'admin')
                                    <i class="bi bi-patch-check-fill me-1 text-primary"></i>Admin Kelurahan
                                @else
                                    Warga Anonim
                                @endif
                            </strong>
                            <small class="text-muted">{{ $resp->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-0 small" style="white-space:pre-wrap;">{{ $resp->response }}</p>
                    </div>
                    @endforeach
                @endif

                @if(Auth::user()->role === 'admin')
                <hr>
                <form action="{{ route('responses.store', $complaint->id) }}" method="POST">
                    @csrf
                    <label class="form-label fw-bold small">Tulis Tanggapan</label>
                    <textarea name="response" class="form-control rounded-3 mb-2"
                        rows="3" required placeholder="Ketik tanggapan atau tindak lanjut..."></textarea>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-send me-2"></i>Kirim Tanggapan
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if($complaint->latitude)
<script>
    const map = L.map('detail-map', {
        zoomControl: false,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        touchZoom: false
    }).setView([{{ $complaint->latitude }}, {{ $complaint->longitude }}], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    L.marker([{{ $complaint->latitude }}, {{ $complaint->longitude }}])
        .addTo(map)
        .bindPopup('{{ addslashes($complaint->location ?? "Lokasi Pengaduan") }}')
        .openPopup();
</script>
@endif
@endpush
