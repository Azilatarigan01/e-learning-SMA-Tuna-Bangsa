@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-award fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 8: BIMBINGAN WALI KELAS
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Catatan Pembinaan & Apresiasi Karakter</h3>
                        <p class="text-white-50 small mb-0">Umpan balik bimbingan belajar, catatan prestasi, dan penguatan karakter dari wali kelas Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guidance History Cards -->
<div class="row g-4">
    @forelse($guidances as $g)
        <div class="col-lg-6 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid {{ $g->category == 'Prestasi' ? '#198754' : ($g->category == 'Akademik' ? '#0d6efd' : '#851624') }} !important; background: white;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge {{ $g->category == 'Prestasi' ? 'bg-success' : ($g->category == 'Akademik' ? 'bg-primary' : 'bg-danger') }} fw-bold px-2 py-1">
                                {{ $g->category }}
                            </span>
                            <small class="text-muted">
                                <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($g->date)) }}
                            </small>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $g->title }}</h5>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">{{ $g->description }}</p>

                        @if($g->action_taken)
                            <div class="p-3 bg-light rounded-3 mb-2" style="font-size: 0.85rem;">
                                <strong class="text-dark d-block mb-1"><i class="fa-solid fa-lightbulb text-warning me-1"></i> Arahan / Solusi Wali Kelas:</strong>
                                <span class="text-secondary">{{ $g->action_taken }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted small">
                        <span>
                            <i class="fa-solid fa-user-tie me-1"></i> Wali Kelas: <strong>{{ $g->homeroomTeacher->name ?? 'Wali Kelas' }}</strong>
                        </span>
                        <span class="badge {{ $g->follow_up_status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }} fw-bold">
                            {{ $g->follow_up_status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
                <i class="fa-solid fa-heart-circle-check fs-1 text-success mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada catatan pembinaan khusus</h5>
                <p class="text-muted small">Apresiasi karakter atau catatan bimbingan belajar dari wali kelas akan muncul di halaman ini.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
