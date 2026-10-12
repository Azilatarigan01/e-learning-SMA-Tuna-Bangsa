@extends('layouts.app')

@section('container')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Ruangan</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $getRecord->count() }}</h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(133, 22, 36, 0.1); color: #851624; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-door-open fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Ruang Teori</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $getRecord->where('type', 'Kelas Teori')->count() }}</h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(13, 110, 253, 0.1); color: #0d6efd; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-chalkboard fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Laboratorium & CBT</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $getRecord->filter(function($r){ return str_contains(strtolower($r->type), 'lab'); })->count() }}</h3>
                </div>
                <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(25, 135, 84, 0.1); color: #198754; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-flask-vial fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px; background: white;">
            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Siap Digunakan</span>
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
                    <i class="fa-solid fa-door-open text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Master Ruangan & Fasilitas SMA Tuna Bangsa</h5>
                </div>
                <a href="{{ url('admin/room/add') }}" class="btn btn-sm btn-warning text-dark fw-bold px-3">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Ruangan Baru
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
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Tipe / Kategori</th>
                                <th scope="col" class="text-center">Kapasitas</th>
                                <th scope="col" class="text-center">Status Kesiapan</th>
                                <th scope="col">Keterangan / Fasilitas</th>
                                <th scope="col" class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecord as $record)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="lms-avatar" style="width: 38px; height: 38px; font-size: 0.9rem; background: #fff1f2; color: #851624;">
                                            @if(str_contains(strtolower($record->type), 'lab'))
                                                <i class="fa-solid fa-desktop"></i>
                                            @elseif(str_contains(strtolower($record->type), 'aula'))
                                                <i class="fa-solid fa-landmark"></i>
                                            @elseif(str_contains(strtolower($record->type), 'lapangan'))
                                                <i class="fa-solid fa-volleyball"></i>
                                            @else
                                                <i class="fa-solid fa-chalkboard"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark">{{ $record->name }}</span>
                                            <div class="text-muted small">ID: #RM-{{ str_pad($record->id, 3, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                                        {{ $record->type }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold text-dark">{{ $record->capacity }}</span> <span class="text-muted small">Kursi</span>
                                </td>
                                <td class="text-center">
                                    @if($record->status == 0)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Tersedia
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-screwdriver-wrench me-1"></i> Maintenance
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ !empty($record->notes) ? $record->notes : '—' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ url('admin/room/edit', $record->id) }}" class="btn btn-sm btn-primary px-3">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.room.delete', $record->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ruangan ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-2">
                                                <i class="fa-solid fa-trash me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data ruangan yang terdaftar.
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
