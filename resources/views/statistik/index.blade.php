@extends('layouts.app')
@section('title', 'Statistik Pengaduan')

@push('styles')
<style>
    .stat-mini { border-radius:12px; border:none; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:1.25rem; }
    .card-premium { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .table th { font-size:.75rem; text-transform:uppercase; letter-spacing:.05em; color:#90a4ae; font-weight:700; }
    .table td { font-size:.88rem; vertical-align:middle; }
</style>
@endpush

@section('content')
<h5 class="fw-bold mb-4"><i class="bi bi-bar-chart-line me-2 text-primary"></i>Statistik Pengaduan</h5>

{{-- Ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-mini" style="background:linear-gradient(135deg,#1565c0,#1e88e5);color:white;">
            <div style="font-size:.7rem;font-weight:700;opacity:.8;text-transform:uppercase;">Total</div>
            <div style="font-size:2rem;font-weight:800;">{{ $total_all }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-mini" style="background:linear-gradient(135deg,#e65100,#fb8c00);color:white;">
            <div style="font-size:.7rem;font-weight:700;opacity:.8;text-transform:uppercase;">Menunggu</div>
            <div style="font-size:2rem;font-weight:800;">{{ $total_menunggu }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-mini" style="background:linear-gradient(135deg,#00695c,#00897b);color:white;">
            <div style="font-size:.7rem;font-weight:700;opacity:.8;text-transform:uppercase;">Diproses</div>
            <div style="font-size:2rem;font-weight:800;">{{ $total_diproses }}</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-mini" style="background:linear-gradient(135deg,#1b5e20,#2e7d32);color:white;">
            <div style="font-size:.7rem;font-weight:700;opacity:.8;text-transform:uppercase;">Selesai</div>
            <div style="font-size:2rem;font-weight:800;">{{ $total_selesai }}</div>
        </div>
    </div>
</div>

{{-- Grafik --}}
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card card-premium p-4">
            <h6 class="fw-bold mb-3">Tren Pengaduan 12 Bulan Terakhir</h6>
            <canvas id="chartTren" height="100"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-premium p-4">
            <h6 class="fw-bold mb-3">Distribusi Status</h6>
            <canvas id="chartPie" height="200"></canvas>
            <div class="mt-3">
                @if($total_all > 0)
                <div class="d-flex justify-content-between small mb-1">
                    <span>✅ Selesai</span>
                    <strong>{{ round(($total_selesai / $total_all) * 100, 1) }}%</strong>
                </div>
                <div class="progress mb-2" style="height:6px;">
                    <div class="progress-bar bg-success" style="width:{{ $total_all > 0 ? ($total_selesai/$total_all)*100 : 0 }}%"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Grafik Per Status Bulanan --}}
<div class="card card-premium p-4 mb-4">
    <h6 class="fw-bold mb-3">Pengaduan Per Status (12 Bulan)</h6>
    <canvas id="chartGrouped" height="80"></canvas>
</div>

{{-- Tabel Rekapitulasi --}}
<div class="card card-premium p-4">
    <h6 class="fw-bold mb-3">Rekapitulasi Bulanan</h6>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Bulan</th>
                    <th class="text-center">Menunggu</th>
                    <th class="text-center">Diproses</th>
                    <th class="text-center">Selesai</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekap as $r)
                <tr>
                    <td class="fw-medium">{{ $r['label'] }}</td>
                    <td class="text-center">
                        @if($r['menunggu'] > 0)
                            <span class="badge" style="background:#fff3e0;color:#e65100;">{{ $r['menunggu'] }}</span>
                        @else <span class="text-muted">0</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($r['diproses'] > 0)
                            <span class="badge" style="background:#e0f2f1;color:#00695c;">{{ $r['diproses'] }}</span>
                        @else <span class="text-muted">0</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($r['selesai'] > 0)
                            <span class="badge" style="background:#e8f5e9;color:#1b5e20;">{{ $r['selesai'] }}</span>
                        @else <span class="text-muted">0</span>
                        @endif
                    </td>
                    <td class="text-center"><strong>{{ $r['total'] }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const labels = {!! json_encode($monthly_labels->values()) !!};
const totalData = {!! json_encode($monthly_total->values()) !!};
const menungguData = {!! json_encode($monthly_menunggu->values()) !!};
const diprosesData = {!! json_encode($monthly_diproses->values()) !!};
const selesaiData  = {!! json_encode($monthly_selesai->values()) !!};

new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Pengaduan',
            data: totalData,
            borderColor: '#3949ab',
            backgroundColor: 'rgba(57,73,171,0.1)',
            borderWidth: 2.5,
            tension: 0.4, fill: true, pointRadius: 4, pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { 
            y: { beginAtZero: true, ticks: { stepSize: 1 } }, 
            x: { 
                grid: { display: false },
                ticks: { autoSkip: true, maxRotation: 0, minRotation: 0, maxTicksLimit: 6, font: { size: 10 } }
            } 
        }
    }
});

new Chart(document.getElementById('chartPie'), {
    type: 'doughnut',
    data: {
        labels: ['Menunggu', 'Diproses', 'Selesai'],
        datasets: [{ data: [{{ $total_menunggu }}, {{ $total_diproses }}, {{ $total_selesai }}],
            backgroundColor: ['#fb8c00','#00897b','#2e7d32'], borderWidth: 0, hoverOffset: 5 }]
    },
    options: { responsive: true, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } } }
});

new Chart(document.getElementById('chartGrouped'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            { label: 'Menunggu', data: menungguData, backgroundColor: '#fb8c00', borderRadius: 4 },
            { label: 'Diproses', data: diprosesData, backgroundColor: '#00897b', borderRadius: 4 },
            { label: 'Selesai',  data: selesaiData,  backgroundColor: '#2e7d32', borderRadius: 4 },
        ]
    },
    options: {
        responsive: true, 
        scales: { 
            x: { 
                stacked: true, 
                grid: { display: false },
                ticks: { autoSkip: true, maxRotation: 0, minRotation: 0, maxTicksLimit: 6, font: { size: 10 } }
            }, 
            y: { stacked: true, beginAtZero: true } 
        },
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }
    }
});
</script>
@endpush
