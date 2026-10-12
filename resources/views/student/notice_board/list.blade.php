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
                            TAHAP 8: INFORMASI SISWA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Papan Pengumuman & Informasi Sekolah</h3>
                        <p class="text-white-50 small mb-0">Pengumuman resmi dari sekolah dan wali kelas untuk Anda di SMA Tuna Bangsa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notice Cards Feed -->
<div class="row g-4">
    @forelse($notices as $n)
        <div class="col-lg-6 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid {{ $n->priority == 'urgent' ? '#dc3545' : ($n->priority == 'info' ? '#0d6efd' : '#851624') }} !important; background: white;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge {{ $n->priority == 'urgent' ? 'bg-danger' : ($n->priority == 'info' ? 'bg-primary' : 'bg-secondary') }} fw-bold px-2 py-1">
                                {{ strtoupper($n->priority) }}
                            </span>
                            <small class="text-muted">
                                <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($n->notice_date)) }}
                            </small>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $n->title }}</h5>
                        <p class="text-secondary small mb-3" style="line-height: 1.6; white-space: pre-line;">{{ $n->message }}</p>
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted small">
                        <span>
                            <i class="fa-solid fa-user-pen me-1"></i> Dari: <strong>{{ $n->author->name ?? 'Admin / Guru' }}</strong>
                        </span>
                        @if($n->target_class_id)
                            <span class="badge bg-light text-dark border">
                                <i class="fa-solid fa-chalkboard me-1"></i> Kelas {{ $n->targetClass->name ?? '' }}
                            </span>
                        @else
                            <span class="badge bg-light text-primary border">
                                <i class="fa-solid fa-globe me-1"></i> Pengumuman Umum
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
                <i class="fa-solid fa-bell-slash fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Tidak ada pengumuman baru</h5>
                <p class="text-muted small">Seluruh pengumuman terbaru dari pihak sekolah akan ditampilkan di halaman ini.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
