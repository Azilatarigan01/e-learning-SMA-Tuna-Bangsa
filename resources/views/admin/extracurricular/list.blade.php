@extends('layouts.app')

@section('container')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Ekskul</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $getRecord->count() }}</h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(133, 22, 36, 0.1); color: #851624; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trophy fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Siswa Aktif</span>
                    <h3 class="fw-bold mb-0 text-primary">
                        {{ $getRecord->sum(function($e) { return $e->members->count(); }) }}
                    </h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(13, 110, 253, 0.1); color: #0d6efd; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-users fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Guru Pembina</span>
                    <h3 class="fw-bold mb-0 text-dark">
                        {{ $getRecord->whereNotNull('teacher_id')->unique('teacher_id')->count() }}
                    </h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(197, 155, 39, 0.15); color: #c59b27; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-chalkboard-user fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Ekskul Aktif</span>
                    <h3 class="fw-bold mb-0 text-success">{{ $getRecord->where('status', 0)->count() }}</h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(25, 135, 84, 0.15); color: #198754; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-award text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Katalog & Manajemen Ekstrakurikuler SMA Tuna Bangsa</h5>
                </div>
                <a href="{{ url('admin/extracurricular/add') }}" class="btn btn-sm btn-warning text-dark fw-bold px-3">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Ekskul Baru
                </a>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Nama Ekstrakurikuler</th>
                                <th scope="col">Guru Pembina</th>
                                <th scope="col">Jadwal & Tempat</th>
                                <th scope="col" class="text-center">Kapasitas / Anggota</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center" style="width: 240px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecord as $record)
                            @php
                                $memberCount = $record->members->count();
                                $pct = $record->quota > 0 ? min(100, round(($memberCount / $record->quota) * 100)) : 0;
                            @endphp
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="lms-avatar" style="width: 42px; height: 42px; font-size: 1.1rem; background: linear-gradient(135deg, #851624, #a81c2d); color: #fff;">
                                            <i class="fa-solid {{ !empty($record->icon) ? $record->icon : 'fa-star' }}"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark fs-6">{{ $record->name }}</div>
                                            <span class="badge bg-light text-secondary border px-2 py-0 small">
                                                {{ $record->category }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(!empty($record->teacher))
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width: 28px; height: 28px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold;">
                                                {{ strtoupper(substr($record->teacher->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark small">{{ $record->teacher->name }}</div>
                                                <small class="text-muted">{{ $record->teacher->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small italic">Belum ditentukan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small fw-semibold text-dark">
                                        <i class="fa-regular fa-calendar-days text-muted me-1"></i>
                                        {{ !empty($record->day_of_week) ? $record->day_of_week : '—' }} 
                                        @if(!empty($record->start_time))
                                            ({{ $record->start_time }} - {{ $record->end_time }})
                                        @endif
                                    </div>
                                    <div class="small text-muted mt-1">
                                        <i class="fa-solid fa-location-dot text-danger me-1"></i>
                                        {{ !empty($record->location) ? $record->location : 'Lokasi belum diatur' }}
                                    </div>
                                </td>
                                <td class="text-center" style="min-width: 130px;">
                                    <div class="d-flex align-items-center justify-content-center gap-1 mb-1">
                                        <span class="fw-bold text-dark">{{ $memberCount }}</span>
                                        <span class="text-muted small">/ {{ $record->quota }} Siswa</span>
                                    </div>
                                    <div class="progress" style="height: 6px; border-radius: 10px;">
                                        <div class="progress-bar {{ $pct >= 90 ? 'bg-danger' : ($pct >= 60 ? 'bg-warning' : 'bg-success') }}" style="width: {{ $pct }}%;"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($record->status == 0)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-pause me-1"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ url('admin/extracurricular/members', $record->id) }}" class="btn btn-sm btn-info text-white px-2" title="Kelola Anggota Siswa">
                                            <i class="fa-solid fa-users me-1"></i> Anggota ({{ $memberCount }})
                                        </a>
                                        <a href="{{ url('admin/extracurricular/edit', $record->id) }}" class="btn btn-sm btn-primary px-2" title="Edit Ekskul">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.extracurricular.delete', $record->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekskul {{ $record->name }} beserta seluruh anggotanya?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-2" title="Hapus Ekskul">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data ekstrakurikuler yang terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
