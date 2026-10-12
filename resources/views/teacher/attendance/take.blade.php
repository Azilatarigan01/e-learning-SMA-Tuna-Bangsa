@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-clipboard-user fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            PRESENSI HARIAN KBM
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Input Presensi & Kehadiran Siswa</h3>
                        <p class="text-white-50 small mb-0">Catat dan pantau kehadiran siswa pada jam pelajaran Anda di SMA Tuna Bangsa.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('teacher.attendance.report') }}" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-chart-pie me-1"></i> Lihat Rekap Kehadiran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Selection Form -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-sliders text-primary"></i> Pilih Sesi KBM yang Akan Diabsen
                </h6>
            </div>
            <div class="card-body p-4">
                <form method="GET" action="{{ route('teacher.attendance.take') }}" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Kelas / Rombel <span class="text-danger">*</span></label>
                        <select name="class_id" id="getClass" class="form-select" required onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($getClass as $c)
                                <option value="{{ $c->id }}" {{ $class_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="subject_id" class="form-select" required onchange="this.form.submit()">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @if(!empty($getSubject))
                                @foreach($getSubject as $s)
                                    <option value="{{ $s->subject_id }}" {{ $subject_id == $s->subject_id ? 'selected' : '' }}>
                                        {{ $s->subject_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Tanggal KBM <span class="text-danger">*</span></label>
                        <input type="date" name="attendance_date" class="form-control" value="{{ $attendance_date }}" required onchange="this.form.submit()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Pertemuan / Sesi</label>
                        <input type="text" name="meeting_number" class="form-control" placeholder="Contoh: Pertemuan 1" value="{{ $meeting_number }}">
                    </div>
                </form>
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

<!-- Attendance Sheet Table -->
@if(!empty($getStudents) && count($getStudents) > 0)
<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('teacher.attendance.submit') }}">
            {{ csrf_field() }}
            <input type="hidden" name="class_id" value="{{ $class_id }}">
            <input type="hidden" name="subject_id" value="{{ $subject_id }}">
            <input type="hidden" name="attendance_date" value="{{ $attendance_date }}">
            <input type="hidden" name="meeting_number" value="{{ $meeting_number }}">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex flex-wrap align-items-center justify-content-between py-3 px-4 gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users text-warning fs-5"></i>
                        <h5 class="mb-0 fw-bold">Lembar Presensi ({{ count($getStudents) }} Siswa)</h5>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-success fw-bold px-3" onclick="setAllPresent()">
                            <i class="fa-solid fa-check-double me-1"></i> Tandai Semua Hadir
                        </button>
                        <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Presensi
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 50px;">No</th>
                                    <th scope="col" class="text-center" style="width: 90px;">No. Absen</th>
                                    <th scope="col">Nama Lengkap Siswa</th>
                                    <th scope="col" class="text-center" style="width: 380px;">Status Kehadiran</th>
                                    <th scope="col" style="width: 250px;">Catatan / Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getStudents as $student)
                                @php
                                    $savedStatus = isset($existingAttendance[$student->id]) ? $existingAttendance[$student->id]->attendance_status : 1;
                                    $savedNotes = isset($existingAttendance[$student->id]) ? $existingAttendance[$student->id]->notes : '';
                                @endphp
                                <tr>
                                    <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                            #{{ $student->roll_number ?? $loop->iteration }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lms-avatar" style="width: 36px; height: 36px; font-size: 0.85rem; background: #fee2e2; color: #991b1b;">
                                                {{ strtoupper(substr($student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $student->name }}</div>
                                                <small class="text-muted">NISN: {{ $student->admission_number ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input radio-hadir" type="radio" name="attendance[{{ $student->id }}]" id="hadir_{{ $student->id }}" value="1" {{ $savedStatus == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-success small" for="hadir_{{ $student->id }}">
                                                    Hadir
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="attendance[{{ $student->id }}]" id="sakit_{{ $student->id }}" value="2" {{ $savedStatus == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-warning small" for="sakit_{{ $student->id }}">
                                                    Sakit
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="attendance[{{ $student->id }}]" id="izin_{{ $student->id }}" value="3" {{ $savedStatus == 3 ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-info small" for="izin_{{ $student->id }}">
                                                    Izin
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="attendance[{{ $student->id }}]" id="alpa_{{ $student->id }}" value="4" {{ $savedStatus == 4 ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-danger small" for="alpa_{{ $student->id }}">
                                                    Alpa
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="notes[{{ $student->id }}]" class="form-control form-control-sm" placeholder="Catatan (opsional)" value="{{ $savedNotes }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        <i class="fa-solid fa-circle-info text-primary me-1"></i> Pastikan seluruh siswa terdata sebelum menyimpan.
                    </span>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data Presensi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@elseif(!empty($class_id) && !empty($subject_id))
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <p class="text-muted mb-0">Belum ada data siswa di kelas ini.</p>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <div class="card-body">
                <i class="fa-solid fa-hand-pointer fa-3x text-muted mb-3 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Silakan Pilih Kelas dan Mata Pelajaran</h6>
                <p class="text-muted small mb-0">Pilih kelas dan mata pelajaran pada form di atas untuk menampilkan lembar presensi seluruh siswa.</p>
            </div>
        </div>
    </div>
</div>
@endif

<script>
function setAllPresent() {
    const radioHadir = document.querySelectorAll('.radio-hadir');
    radioHadir.forEach(radio => {
        radio.checked = true;
    });
}
</script>
@endsection
