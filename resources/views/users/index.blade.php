@extends('layouts.app')
@section('title', 'Manajemen Pengguna')

@push('styles')
<style>
    .card-premium { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
    .table th { font-size:.75rem; text-transform:uppercase; letter-spacing:.05em; color:#90a4ae; font-weight:700; }
    .table td { vertical-align:middle; font-size:.88rem; }
    .user-avatar-sm {
        width:34px; height:34px; border-radius:50%;
        display:inline-flex; align-items:center; justify-content:center;
        font-size:.8rem; font-weight:700; color:white; flex-shrink:0;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0"><i class="bi bi-people me-2 text-primary"></i>Manajemen Pengguna</h5>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pengguna
    </a>
</div>

<div class="card card-premium">
    <div class="card-body p-0">
        @if($users->isEmpty())
            <div class="text-center py-5 text-muted">Belum ada pengguna.</div>
        @else
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar-sm" style="background:{{ $u->role === 'admin' ? '#3949ab' : '#2e7d32' }}">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        {{ $u->role === 'warga' ? 'Warga Anonim' : $u->name }}
                                    </div>
                                    <div class="text-muted" style="font-size:.72rem;">ID: {{ $u->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td>
                            @if($u->role === 'admin')
                                <span class="badge bg-primary bg-opacity-15 text-primary px-3 py-1 rounded-pill">Admin</span>
                            @else
                                <span class="badge bg-success bg-opacity-15 text-success px-3 py-1 rounded-pill">Warga</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $u->created_at->format('d M Y') }}</td>
                        <td class="pe-4">
                            <div class="d-flex gap-1">
                                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($u->id !== auth()->id())
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
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
