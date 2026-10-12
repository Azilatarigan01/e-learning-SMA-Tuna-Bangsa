@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-calendar-plus fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 7: TAMBAH JADWAL KBM
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Tambah Slot Jadwal Pelajaran</h3>
                        <p class="text-white-50 small mb-0">Atur penempatan hari, jam pelajaran, guru, kelas, dan ruangan dengan proteksi bentrok waktu otomatis.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.timetable.list', ['class_id' => $selectedClassId]) }}" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Error (e.g., Conflict Detected) -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert" style="border-radius: 14px; background-color: #f8d7da; color: #842029;">
    <i class="fa-solid fa-triangle-exclamation fs-3"></i>
    <div>
        <h6 class="fw-bold mb-1">Terdeteksi Bentrok Jadwal!</h6>
        <p class="mb-0 small">{{ session('error') }}</p>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Anti-Conflict Rule Info Banner -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; background-color: #fff9e6; border-left: 4px solid #c59b27 !important;">
    <div class="card-body p-3 d-flex align-items-center gap-3">
        <i class="fa-solid fa-shield-halved fs-3" style="color: #c59b27;"></i>
        <div class="small text-dark">
            <strong>Aturan Validasi Anti-Bentrok Sistem (PRD Bab 9):</strong> Sistem secara otomatis memeriksa dan memblokir jika:
            (1) <em>Guru</em> mengajar dua kelas pada jam yang sama, 
            (2) <em>Kelas</em> memiliki dua mapel pada waktu bertumpuk, atau 
            (3) <em>Ruangan/Lab</em> digunakan lebih dari satu kelas pada jam yang bersamaan.
        </div>
    </div>
</div>

<!-- Add Timetable Form -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-danger"></i> Formulir Jadwal KBM Baru
        </h6>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.timetable.insert') }}">
            @csrf

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Rombongan Kelas <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ (old('class_id') == $c->id || $selectedClassId == $c->id) ? 'selected' : '' }}>
                                {{ $c->name }} (40 Siswa)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Mata Pelajaran <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}" {{ old('subject_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->name }} ({{ $s->type == 1 ? 'Teori' : 'Praktikum' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Guru Pengampu <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $t)
                            <option value="{{ $t->id }}" {{ old('teacher_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Ruangan / Laboratorium / Lokasi <span class="text-danger">*</span></label>
                    <select name="room_id" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Ruangan / Lab --</option>
                        @foreach($rooms as $r)
                            <option value="{{ $r->id }}" {{ old('room_id') == $r->id ? 'selected' : '' }}>
                                {{ $r->name }} ({{ $r->type }} - Kapasitas: {{ $r->capacity }} orang)
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Hari <span class="text-danger">*</span></label>
                    <select name="day_of_week" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="time" name="start_time" class="form-control shadow-sm" required value="{{ old('start_time', '07:30') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Waktu Selesai <span class="text-danger">*</span></label>
                    <input type="time" name="end_time" class="form-control shadow-sm" required value="{{ old('end_time', '09:00') }}">
                </div>
            </div>

            <!-- Jam Pelajaran Presets -->
            <div class="mb-4 p-3 bg-light rounded-3">
                <span class="small fw-semibold text-muted d-block mb-2">Preset Jam Pelajaran Standar SMA Tuna Bangsa:</span>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setPreset('07:30', '09:00')">
                        Jam 1-2 (07:30 - 09:00)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setPreset('09:15', '10:45')">
                        Jam 3-4 (09:15 - 10:45)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setPreset('11:00', '12:30')">
                        Jam 5-6 (11:00 - 12:30)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setPreset('13:15', '14:45')">
                        Jam 7-8 (13:15 - 14:45)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setPreset('15:00', '16:30')">
                        Sore / Praktikum (15:00 - 16:30)
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.timetable.list', ['class_id' => $selectedClassId]) }}" class="btn btn-light border px-4">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #851624; border-color: #851624;">
                    <i class="fa-solid fa-save me-1"></i> Simpan & Validasi Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function setPreset(start, end) {
    document.querySelector('input[name="start_time"]').value = start;
    document.querySelector('input[name="end_time"]').value = end;
}
</script>
@endsection
