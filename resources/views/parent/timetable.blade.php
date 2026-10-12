@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-calendar-days fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            PORTAL ORANG TUA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Jadwal Pelajaran KBM Anak</h3>
                        <p class="text-white-50 small mb-0">Rombongan Kelas: <strong>{{ $class->name ?? 'Kelas' }}</strong> • Semester Ganjil 2026/2027</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-print me-1"></i> Cetak Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Weekly Schedule Day Grid -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-clock text-danger"></i> Agenda Belajar Kelas {{ $class->name ?? '' }} (Senin - Jumat)
        </h6>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            @foreach($days as $day)
                @php
                    $daySlots = $timetables->get($day, collect());
                @endphp
                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 p-3 h-100" style="background-color: #fdfdfd; border-color: #e9ecef !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2" style="color: #851624;">
                                <i class="fa-regular fa-calendar-check"></i> {{ $day }}
                            </h6>
                            <span class="badge bg-light text-dark border">{{ $daySlots->count() }} Mapel</span>
                        </div>

                        @if($daySlots->isNotEmpty())
                            <div class="d-flex flex-column gap-2">
                                @foreach($daySlots as $slot)
                                    <div class="card border-0 shadow-sm p-3" style="background: white; border-radius: 10px; border-left: 4px solid #851624 !important;">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.75rem;">
                                                <i class="fa-regular fa-clock me-1"></i> {{ substr($slot->start_time, 0, 5) }} - {{ substr($slot->end_time, 0, 5) }}
                                            </span>
                                            <span class="badge bg-light text-secondary border" style="font-size: 0.75rem;">
                                                <i class="fa-solid fa-door-open me-1"></i> {{ $slot->room->name ?? 'Ruang Kelas' }}
                                            </span>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $slot->subjectModel->name ?? 'Mata Pelajaran' }}</h6>
                                        <small class="text-muted d-flex align-items-center gap-1">
                                            <i class="fa-solid fa-chalkboard-user text-muted"></i> {{ $slot->teacher->name ?? 'Guru Pengampu' }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted small">
                                Tidak ada jam belajar terjadwal pada hari {{ $day }}.
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
