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
                            TAHAP 7: JADWAL KBM & ANTI-BENTROK
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Jadwal Pelajaran KBM & Validasi Anti-Bentrok</h3>
                        <p class="text-white-50 small mb-0">Kelola jadwal belajar mengajar mingguan dengan validasi anti-bentrok otomatis untuk guru, kelas, dan ruangan (PRD Bab 9).</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.timetable.add', ['class_id' => $selectedClassId]) }}" class="btn btn-warning text-dark fw-bold px-3 shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Slot Jadwal
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-print me-1"></i> Cetak Jadwal
                    </button>
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

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 12px;">
    <i class="fa-solid fa-triangle-exclamation fs-5"></i>
    <div><strong>Gagal Menyimpan!</strong> {{ session('error') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Stats Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Slot Jadwal</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_slots'] }} Sesi</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Seluruh sekolah</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-clock fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Sesi Kelas Terpilih</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $stats['class_slots'] }} Sesi</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">{{ $selectedClass->name ?? 'Kelas' }}</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-primary">
                    <i class="fa-solid fa-chalkboard-user fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #198754 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Fasilitas / Ruangan</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['total_rooms'] }} Lokasi</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Lab & Ruang Teori</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-school fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #c59b27 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Mesin Validasi</span>
                    <h4 class="fw-bold mb-0 text-warning" style="color: #c59b27 !important;">AKTIF</h4>
                    <span class="badge bg-success-subtle text-success fw-bold" style="font-size: 0.75rem;">Anti-Bentrok 100%</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-warning">
                    <i class="fa-solid fa-shield-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Class Filter Card -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.timetable.list') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <label class="form-label fw-semibold small mb-1">Pilih Rombongan Kelas (12 Rombel Aktif)</label>
                <select name="class_id" class="form-select" onchange="this.form.submit()">
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                            {{ $c->name }} (40 Siswa)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-end justify-content-md-end gap-2">
                <a href="{{ route('admin.timetable.add', ['class_id' => $selectedClassId]) }}" class="btn btn-primary fw-bold px-3" style="background-color: #851624; border-color: #851624;">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Pelajaran ke Kelas Ini
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Weekly Schedule Day Tabs & Grid -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="fa-solid fa-table text-danger"></i> Jadwal Mingguan: {{ $selectedClass->name ?? 'Kelas' }}
            </h6>
            <small class="text-muted">Tahun Pelajaran 2026/2027 • Semester Ganjil</small>
        </div>
        <span class="badge bg-secondary rounded-pill">{{ $timetableByDay->flatten()->count() }} Total Mata Pelajaran Terjadwal</span>
    </div>

    <div class="card-body p-4">
        <div class="row g-4">
            @foreach($days as $day)
                @php
                    $daySlots = $timetableByDay->get($day, collect());
                @endphp
                <div class="col-lg-6 col-12">
                    <div class="border rounded-3 p-3 h-100" style="background-color: #fdfdfd; border-color: #e9ecef !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2" style="color: #851624;">
                                <i class="fa-regular fa-calendar-check"></i> {{ $day }}
                            </h6>
                            <span class="badge bg-light text-dark border">{{ $daySlots->count() }} Sesi</span>
                        </div>

                        @if($daySlots->isNotEmpty())
                            <div class="d-flex flex-column gap-2">
                                @foreach($daySlots as $slot)
                                    <div class="card border-0 shadow-sm p-3" style="background: white; border-radius: 10px; border-left: 4px solid #851624 !important;">
                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-1">
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
                                            <div>
                                                <form method="POST" action="{{ route('admin.timetable.delete', $slot->id) }}" onsubmit="return confirm('Hapus slot jadwal ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger p-1" style="width: 28px; height: 28px; border-radius: 6px;" title="Hapus Slot">
                                                        <i class="fa-solid fa-trash-can" style="font-size: 0.75rem;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted small">
                                <i class="fa-regular fa-calendar-xmark fs-4 d-block mb-1 text-black-50"></i>
                                Tidak ada jadwal KBM pada hari {{ $day }}.
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
