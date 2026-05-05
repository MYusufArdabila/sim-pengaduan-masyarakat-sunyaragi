@extends('layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    .stat-card {
        border-radius: 16px;
        border: none;
        padding: 1.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
    .stat-card .bg-icon {
        position: absolute; right: -10px; bottom: -10px;
        font-size: 5rem; opacity: .15;
    }
    .stat-card .stat-num { font-size: 2.2rem; font-weight: 800; line-height: 1; }
    .stat-card .stat-label { font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; opacity: .9; }
    .card-premium { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .section-title { font-size: 1rem; font-weight: 700; color: #37474f; margin-bottom: 1rem; }
    .recent-item {
        display: flex; align-items: center; gap: .75rem;
        padding: .65rem 0; border-bottom: 1px solid #f0f2f7;
    }
    .recent-item:last-child { border-bottom: none; }
    .recent-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem; flex-shrink: 0;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #1a237e, #3949ab);
        border-radius: 16px; color: white;
        padding: 1.5rem 2rem; margin-bottom: 1.5rem;
        position: relative; overflow: hidden;
    }
    .welcome-banner::after {
        content: '\F472'; font-family: 'bootstrap-icons';
        position: absolute; right: 1.5rem; top: 50%;
        transform: translateY(-50%);
        font-size: 5rem; opacity: .1;
    }
</style>
@endpush

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div class="small mb-1" style="opacity:.8;">Selamat datang,</div>
    <h4 class="fw-bold mb-1">
        {{ Auth::user()->role === 'warga' ? 'Warga Anonim' : Auth::user()->name }}
    </h4>
    <div class="small" style="opacity:.75;">
        {{ \App\Models\Setting::get('nama_kelurahan', 'Kelurahan Sunyaragi') }} &bull;
        {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @if(Auth::user()->role === 'admin')
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#1565c0,#1e88e5);">
            <div class="stat-label">Total Pengaduan</div>
            <div class="stat-num mt-2">{{ $total_all }}</div>
            <i class="bi bi-clipboard-data bg-icon"></i>
        </div>
    </div>
    @endif
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#e65100,#fb8c00);">
            <div class="stat-label">Menunggu</div>
            <div class="stat-num mt-2">{{ $total_menunggu }}</div>
            <i class="bi bi-hourglass-split bg-icon"></i>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#00695c,#00897b);">
            <div class="stat-label">Diproses</div>
            <div class="stat-num mt-2">{{ $total_diproses }}</div>
            <i class="bi bi-gear-wide-connected bg-icon"></i>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#1b5e20,#2e7d32);">
            <div class="stat-label">Selesai</div>
            <div class="stat-num mt-2">{{ $total_selesai }}</div>
            <i class="bi bi-check2-circle bg-icon"></i>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'warga')
{{-- Warga: Tombol Buat Pengaduan --}}
<div class="card card-premium p-4 mb-4 text-center">
    <i class="bi bi-megaphone text-primary mb-3" style="font-size:2.5rem;"></i>
    <h5 class="fw-bold">Sampaikan Pengaduan Anda</h5>
    <p class="text-muted small mb-3">Laporkan masalah di lingkungan sekitar Anda. Kami akan segera menindaklanjuti.</p>
    <a href="{{ route('complaints.create') }}" class="btn btn-primary px-4 rounded-pill">
        <i class="bi bi-pencil-square me-2"></i>Buat Pengaduan Baru
    </a>
</div>
@else
{{-- Admin: Grafik --}}
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card card-premium p-3 h-100">
            <div class="section-title"><i class="bi bi-bar-chart-line me-2 text-primary"></i>Tren Pengaduan 6 Bulan Terakhir</div>
            <canvas id="chartBulanan" height="100"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-premium p-3 h-100">
            <div class="section-title"><i class="bi bi-pie-chart me-2 text-primary"></i>Distribusi Status</div>
            <canvas id="chartStatus" height="200"></canvas>
            <div class="mt-3 d-flex flex-column gap-1">
                <div class="d-flex justify-content-between small"><span><span class="badge" style="background:#fb8c00;">&nbsp;</span> Menunggu</span><strong>{{ $total_menunggu }}</strong></div>
                <div class="d-flex justify-content-between small"><span><span class="badge" style="background:#00897b;">&nbsp;</span> Diproses</span><strong>{{ $total_diproses }}</strong></div>
                <div class="d-flex justify-content-between small"><span><span class="badge" style="background:#2e7d32;">&nbsp;</span> Selesai</span><strong>{{ $total_selesai }}</strong></div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Complaints --}}
<div class="card card-premium p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-title mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Pengaduan Terbaru</div>
        <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
    </div>
    @forelse($recent_complaints as $c)
    <div class="recent-item">
        <div class="recent-icon {{ $c->status === 'Menunggu' ? 'bg-warning bg-opacity-10 text-warning' : ($c->status === 'Diproses' ? 'bg-info bg-opacity-10 text-info' : 'bg-success bg-opacity-10 text-success') }}">
            <i class="bi bi-{{ $c->status === 'Menunggu' ? 'hourglass-split' : ($c->status === 'Diproses' ? 'gear' : 'check-circle') }}"></i>
        </div>
        <div class="flex-grow-1 overflow-hidden">
            <div class="fw-semibold text-truncate" style="font-size:.88rem;">{{ $c->title }}</div>
            <div class="text-muted" style="font-size:.75rem;">{{ $c->created_at->diffForHumans() }}</div>
        </div>
        <a href="{{ route('complaints.show', $c->id) }}" class="btn btn-sm btn-light border">Detail</a>
    </div>
    @empty
    <p class="text-muted text-center py-3">Belum ada pengaduan.</p>
    @endforelse
</div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@if(Auth::user()->role === 'admin')
<script>
    // Grafik Bulanan
    new Chart(document.getElementById('chartBulanan'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthly_labels->values()) !!},
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: {!! json_encode($monthly_data->values()) !!},
                backgroundColor: 'rgba(57,73,171,0.75)',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
                x: { 
                    grid: { display: false },
                    ticks: { autoSkip: true, maxRotation: 0, minRotation: 0, maxTicksLimit: 6, font: { size: 10 } }
                }
            }
        }
    });

    // Pie Chart Status
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'Diproses', 'Selesai'],
            datasets: [{
                data: {!! json_encode($status_data) !!},
                backgroundColor: ['#fb8c00', '#00897b', '#2e7d32'],
                borderWidth: 0, hoverOffset: 6,
            }]
        },
        options: {
            responsive: true, cutout: '68%',
            plugins: { legend: { display: false } }
        }
    });
</script>
@endif
@endpush
