@extends('layouts.app')
@section('title', Auth::user()->role === 'warga' ? 'Pengaduan' : 'Data Pengaduan')

@push('styles')
<style>
    .table th { font-size:.78rem; text-transform:uppercase; letter-spacing:.05em; color:#90a4ae; font-weight:700; border-top:none; }
    .table td { vertical-align:middle; font-size:.88rem; }
    .badge-status { padding:.35rem .75rem; border-radius:20px; font-size:.75rem; font-weight:600; }
    .card-premium { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .search-box { max-width: 260px; }
    .empty-state { padding: 3rem 1rem; text-align: center; }
    .empty-state i { font-size: 3rem; color: #cfd8dc; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h5 class="fw-bold mb-0">
        <i class="bi bi-card-list me-2 text-primary"></i>
        {{ Auth::user()->role === 'warga' ? 'Pengaduan' : 'Data Pengaduan' }}
    </h5>
    <div class="d-flex gap-2 align-items-center flex-wrap">
        @if(Auth::user()->role === 'warga')
        <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i>Buat Pengaduan
        </a>
        @endif
        {{-- Filter Status --}}
        <select class="form-select form-select-sm rounded-pill" style="width:auto" onchange="filterStatus(this.value)">
            <option value="">Semua Status</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Diproses">Diproses</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
</div>

<div class="card card-premium">
    <div class="card-body p-0">
        @if($complaints->isEmpty())
            <div class="empty-state">
                <i class="bi bi-inbox d-block"></i>
                <h6 class="fw-semibold text-muted">Belum ada pengaduan</h6>
                @if(Auth::user()->role === 'warga')
                    <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm mt-2 rounded-pill">
                        Buat Pengaduan Pertama
                    </a>
                @endif
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="complaintsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        @if(Auth::user()->role === 'admin')<th>Pelapor</th>@endif
                        <th>Judul Pengaduan</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $c)
                    <tr class="complaint-row" data-status="{{ $c->status }}">
                        <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                        @if(Auth::user()->role === 'admin')
                        <td>
                            <span class="badge bg-secondary bg-opacity-15 text-secondary fw-normal">
                                Warga Anonim
                            </span>
                        </td>
                        @endif
                        <td>
                            <div class="fw-semibold text-truncate" style="max-width:220px;">{{ $c->title }}</div>
                        </td>
                        <td>
                            @if($c->category)
                                <span class="badge bg-primary bg-opacity-10 text-primary fw-normal">{{ $c->category->name }}</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            @if($c->status === 'Menunggu')
                                <span class="badge-status" style="background:#fff3e0;color:#e65100;">⏳ Menunggu</span>
                            @elseif($c->status === 'Diproses')
                                <span class="badge-status" style="background:#e0f2f1;color:#00695c;">⚙️ Diproses</span>
                            @else
                                <span class="badge-status" style="background:#e8f5e9;color:#1b5e20;">✅ Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if($c->location)
                                <small class="text-muted text-truncate d-block" style="max-width:160px;" title="{{ $c->location }}">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i>{{ $c->location }}
                                </small>
                            @elseif($c->latitude)
                                <small class="text-muted"><i class="bi bi-geo me-1"></i>{{ $c->latitude }}, {{ $c->longitude }}</small>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $c->created_at->format('d M Y') }}</small></td>
                        <td class="pe-4">
                            <a href="{{ route('complaints.show', $c->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterStatus(val) {
    document.querySelectorAll('.complaint-row').forEach(row => {
        row.style.display = (!val || row.dataset.status === val) ? '' : 'none';
    });
}
</script>
@endpush
