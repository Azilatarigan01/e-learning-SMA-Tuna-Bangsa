@extends('layouts.app')

@section('container')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-trophy fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            PENGEMBANGAN MINAT & BAKAT
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Ekstrakurikuler Siswa SMA Tuna Bangsa</h3>
                        <p class="text-white-50 small mb-0">Ikuti kegiatan ekstrakurikuler untuk mengasah kepemimpinan, prestasi, dan kreativitas Anda di luar jam pelajaran formal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

<!-- Bagian 1: Ekskul yang Sedang Diikuti -->
<div class="d-flex align-items-center gap-2 mb-3">
    <i class="fa-solid fa-award text-warning fs-5"></i>
    <h5 class="fw-bold mb-0 text-dark">Ekstrakurikuler yang Saya Ikuti ({{ $myMemberships->count() }})</h5>
</div>

<div class="row g-3 mb-5">
    @forelse($myMemberships as $membership)
    @php
        $ekskul = $membership->extracurricular;
    @endphp
    @if(!empty($ekskul))
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; border-top: 4px solid #851624 !important;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-secondary border px-2 py-1 small">
                            {{ $ekskul->category }}
                        </span>
                        @if($membership->role == 'Ketua')
                            <span class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold">
                                <i class="fa-solid fa-crown me-1"></i> Ketua
                            </span>
                        @elseif($membership->role == 'Wakil Ketua')
                            <span class="badge bg-info text-dark px-2 py-1 rounded-pill fw-semibold">
                                Wakil Ketua
                            </span>
                        @else
                            <span class="badge bg-success bg-opacity-75 text-white px-2 py-1 rounded-pill">
                                <i class="fa-solid fa-check me-1"></i> {{ $membership->role }}
                            </span>
                        @endif
                    </div>
                    
                    <h5 class="fw-bold text-dark mb-2">{{ $ekskul->name }}</h5>
                    <p class="text-muted small mb-3" style="min-height: 40px;">
                        {{ \Illuminate\Support\Str::limit($ekskul->description, 95) }}
                    </p>

                    <div class="p-3 mb-3" style="background: #fafafa; border-radius: 12px; font-size: 0.85rem;">
                        <div class="mb-2 text-dark">
                            <i class="fa-solid fa-chalkboard-user text-primary me-2"></i>
                            <strong>Pembina:</strong> {{ !empty($ekskul->teacher) ? $ekskul->teacher->name : 'Belum Ada' }}
                        </div>
                        <div class="mb-2 text-dark">
                            <i class="fa-regular fa-calendar-check text-success me-2"></i>
                            <strong>Jadwal:</strong> {{ $ekskul->day_of_week }} ({{ $ekskul->start_time }} - {{ $ekskul->end_time }})
                        </div>
                        <div class="text-dark">
                            <i class="fa-solid fa-location-dot text-danger me-2"></i>
                            <strong>Tempat:</strong> {{ $ekskul->location }}
                        </div>
                    </div>
                </div>

                <div class="pt-2 border-top d-flex align-items-center justify-content-between">
                    <span class="text-muted small">
                        <i class="fa-regular fa-clock me-1"></i> Sejak {{ date('d M Y', strtotime($membership->created_at)) }}
                    </span>
                    <form action="{{ route('student.extracurricular.leave', $ekskul->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari ekstrakurikuler ini?');">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-outline-danger px-3">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <div class="card-body">
                <i class="fa-solid fa-medal fa-3x text-muted mb-3 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Anda Belum Mengikuti Ekstrakurikuler</h6>
                <p class="text-muted small mb-3">Jelajahi pilihan ekskul di bawah ini dan klik tombol daftar untuk bergabung.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Bagian 2: Katalog Ekskul Lain yang Tersedia -->
<div class="d-flex align-items-center gap-2 mb-3">
    <i class="fa-solid fa-compass text-primary fs-5"></i>
    <h5 class="fw-bold mb-0 text-dark">Katalog Ekstrakurikuler Lain yang Tersedia ({{ $availableEkskuls->count() }})</h5>
</div>

<div class="row g-3">
    @forelse($availableEkskuls as $avail)
    @php
        $count = $avail->members->count();
        $isFull = $count >= $avail->quota;
        $remaining = max(0, $avail->quota - $count);
    @endphp
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-secondary border px-2 py-1 small">
                            {{ $avail->category }}
                        </span>
                        @if($isFull)
                            <span class="badge bg-danger px-2 py-1 rounded-pill">
                                Kuota Penuh
                            </span>
                        @else
                            <span class="badge bg-success bg-opacity-75 text-white px-2 py-1 rounded-pill">
                                Sisa {{ $remaining }} Kursi
                            </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="lms-avatar" style="width: 38px; height: 38px; font-size: 1rem; background: #fff1f2; color: #851624;">
                            <i class="fa-solid {{ !empty($avail->icon) ? $avail->icon : 'fa-star' }}"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-0">{{ $avail->name }}</h5>
                    </div>

                    <p class="text-muted small mb-3" style="min-height: 40px;">
                        {{ \Illuminate\Support\Str::limit($avail->description, 95) }}
                    </p>

                    <div class="p-3 mb-3" style="background: #fafafa; border-radius: 12px; font-size: 0.85rem;">
                        <div class="mb-2 text-dark">
                            <i class="fa-solid fa-chalkboard-user text-primary me-2"></i>
                            <strong>Pembina:</strong> {{ !empty($avail->teacher) ? $avail->teacher->name : 'Belum Ada' }}
                        </div>
                        <div class="mb-2 text-dark">
                            <i class="fa-regular fa-calendar-check text-success me-2"></i>
                            <strong>Jadwal:</strong> {{ $avail->day_of_week }} ({{ $avail->start_time }} - {{ $avail->end_time }})
                        </div>
                        <div class="text-dark">
                            <i class="fa-solid fa-location-dot text-danger me-2"></i>
                            <strong>Tempat:</strong> {{ $avail->location }}
                        </div>
                    </div>
                </div>

                <div class="pt-2 border-top">
                    @if(!$isFull)
                        <form action="{{ route('student.extracurricular.join', $avail->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                <i class="fa-solid fa-user-plus me-1"></i> Daftar Ekskul Ini
                            </button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary w-100 py-2 disabled" disabled>
                            <i class="fa-solid fa-ban me-1"></i> Kuota Penuh
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-4" style="border-radius: 14px;">
            <p class="text-muted mb-0">Tidak ada ekstrakurikuler lain yang tersedia saat ini.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
