@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-bullhorn fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 8: PENGUMUMAN & INFORMASI
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Papan Pengumuman & Broadcast Sekolah</h3>
                        <p class="text-white-50 small mb-0">Publikasikan informasi resmi, edaran akademik, dan agenda kegiatan ke guru, siswa, dan orang tua (PRD Bab 12).</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.notice_board.add') }}" class="btn btn-warning text-dark fw-bold px-3 shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Buat Pengumuman Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 12px;">
    <i class="fa-solid fa-circle-check fs-5"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Pengumuman</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_notices'] }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Informasi terpublikasi</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-newspaper fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #dc3545 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Penting / Urgent</span>
                    <h4 class="fw-bold mb-0 text-danger">{{ $stats['urgent_notices'] }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Prioritas mendesak</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-bell fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Seluruh Sekolah</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $stats['school_wide'] }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Audiens umum</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-primary">
                    <i class="fa-solid fa-globe fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #198754 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Khusus Kelas</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['class_specific'] }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Target rombel tertentu</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-chalkboard-user fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notice Board Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-list-check text-primary"></i> Daftar Seluruh Pengumuman
        </h6>
        <span class="badge bg-secondary rounded-pill">{{ $notices->total() }} Pengumuman</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3" style="width: 50px;">No</th>
                    <th class="py-3" style="min-width: 250px;">Judul & Pesan</th>
                    <th class="py-3 text-center" style="width: 120px;">Tanggal</th>
                    <th class="py-3 text-center" style="width: 140px;">Audiens Target</th>
                    <th class="py-3 text-center" style="width: 120px;">Prioritas</th>
                    <th class="py-3" style="width: 160px;">Dibuat Oleh</th>
                    <th class="pe-4 py-3 text-center" style="width: 90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notices as $idx => $n)
                    <tr>
                        <td class="ps-4 text-center fw-bold text-muted">{{ $notices->firstItem() + $idx }}</td>
                        <td>
                            <h6 class="fw-bold text-dark mb-1">{{ $n->title }}</h6>
                            <p class="text-muted small mb-0" style="max-width: 450px;">{{ Str::limit($n->message, 120) }}</p>
                        </td>
                        <td class="text-center text-muted small">
                            <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($n->notice_date)) }}
                        </td>
                        <td class="text-center">
                            @if($n->message_to == 'all')
                                <span class="badge bg-primary">Semua Warga Sekolah</span>
                            @elseif($n->message_to == 'teacher')
                                <span class="badge bg-info text-dark">Dewan Guru</span>
                            @elseif($n->message_to == 'student')
                                <span class="badge bg-success">Seluruh Siswa</span>
                            @endif

                            @if($n->target_class_id)
                                <span class="badge bg-light text-dark border d-block mt-1">{{ $n->targetClass->name ?? 'Kelas' }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($n->priority == 'urgent')
                                <span class="badge bg-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Penting</span>
                            @elseif($n->priority == 'info')
                                <span class="badge bg-info text-dark"><i class="fa-solid fa-circle-info me-1"></i> Informasi</span>
                            @else
                                <span class="badge bg-secondary">Umum</span>
                            @endif
                        </td>
                        <td class="small text-muted">
                            <i class="fa-solid fa-user-pen me-1"></i> {{ $n->author->name ?? 'Admin Sekolah' }}
                        </td>
                        <td class="pe-4 text-center">
                            <form method="POST" action="{{ route('admin.notice_board.delete', $n->id) }}" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger p-1" style="width: 30px; height: 30px; border-radius: 6px;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-bullhorn fs-3 d-block mb-2"></i>
                            Belum ada pengumuman yang diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($notices->hasPages())
    <div class="card-footer bg-white py-3 px-4 border-top">
        {{ $notices->links() }}
    </div>
    @endif
</div>
@endsection
