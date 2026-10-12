@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-graduation-cap fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 6: ASESMEN & RAPOR
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Buku Nilai & Asesmen Siswa</h3>
                        <p class="text-white-50 small mb-0">Kelola nilai tugas, kuis, UTS, dan UAS siswa secara terstruktur dengan kalkulasi bobot otomatis (KKM = 75).</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('teacher.gradebook.report', ['class_id' => $selectedClassId, 'subject_id' => $selectedSubjectId]) }}" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-chart-column me-1"></i> Rekapitulasi & Ranking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 12px; background-color: #d1e7dd; color: #0f5132;">
    <i class="fa-solid fa-circle-check fs-5"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Filter Selection Form -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-filter text-danger"></i> Pilih Kelas & Mata Pelajaran
                </h6>
            </div>
            <div class="card-body p-4">
                <form method="GET" action="{{ route('teacher.gradebook.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small">Kelas / Rombel <span class="text-danger">*</span></label>
                        <select name="class_id" class="form-select shadow-sm" required onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="subject_id" class="form-select shadow-sm" required onchange="this.form.submit()">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} ({{ $s->type == 1 ? 'Teori' : 'Praktikum' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" style="background-color: #851624; border-color: #851624;">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Tampilkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($selectedClassId && $selectedSubjectId)
<!-- Statistics Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Siswa</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_students'] }} Siswa</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Dinilai: {{ $stats['graded_students'] }} / {{ $stats['total_students'] }}</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-users fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Rata-rata Kelas</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $stats['average_score'] ?: '-' }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Standar KKM: 75.0</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-primary">
                    <i class="fa-solid fa-chart-line fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #198754 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Tuntas (>= KKM)</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['pass_count'] }} Siswa</h4>
                    <span class="badge bg-success-subtle text-success fw-bold" style="font-size: 0.75rem;">{{ $stats['pass_rate'] }}% Kelulusan</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-circle-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #dc3545 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Remedial (< 75)</span>
                    <h4 class="fw-bold mb-0 text-danger">{{ $stats['fail_count'] }} Siswa</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Perlu bimbingan khusus</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grade Input Sheet Form -->
<form method="POST" action="{{ route('teacher.gradebook.submit') }}" id="gradebookForm">
    @csrf
    <input type="hidden" name="class_id" value="{{ $selectedClassId }}">
    <input type="hidden" name="subject_id" value="{{ $selectedSubjectId }}">

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-table-list text-primary"></i> Lembar Input Nilai Siswa (Formula: 20% Tugas + 20% Kuis + 30% UTS + 30% UAS)
                </h6>
                <small class="text-muted">Total 40 siswa terdaftar dalam kelas ini. Nilai akhir dihitung secara langsung saat Anda mengetik.</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success fw-bold px-4 shadow-sm" style="background-color: #198754;">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Semua Nilai (Batch Save)
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                <thead style="background-color: #f8f9fa;">
                    <tr class="text-secondary small fw-bold text-uppercase">
                        <th class="ps-4 py-3" style="width: 50px;">No</th>
                        <th class="py-3" style="min-width: 200px;">Nama Siswa & NISN</th>
                        <th class="py-3 text-center" style="width: 100px;">Tugas (20%)</th>
                        <th class="py-3 text-center" style="width: 100px;">Kuis (20%)</th>
                        <th class="py-3 text-center" style="width: 100px;">UTS (30%)</th>
                        <th class="py-3 text-center" style="width: 100px;">UAS (30%)</th>
                        <th class="py-3 text-center" style="width: 100px;">Nilai Akhir</th>
                        <th class="py-3 text-center" style="width: 80px;">Predikat</th>
                        <th class="py-3 text-center" style="width: 100px;">Status</th>
                        <th class="pe-4 py-3" style="min-width: 220px;">Catatan Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $idx => $student)
                        @php
                            $grade = $existingGrades->get($student->id);
                            $hw = $grade ? $grade->homework_score : '';
                            $quiz = $grade ? $grade->quiz_score : '';
                            $mid = $grade ? $grade->midterm_score : '';
                            $uas = $grade ? $grade->final_exam_score : '';
                            $final = $grade ? $grade->final_score : '';
                            $letter = $grade ? $grade->grade_letter : '-';
                            $passing = $grade ? $grade->passing_status : null;
                            $notes = $grade ? $grade->competency_notes : '';
                        @endphp
                        <tr id="row-{{ $student->id }}" class="grade-row">
                            <td class="ps-4 text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 34px; height: 34px; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #851624; font-size: 0.8rem;">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $student->name }}</div>
                                        <small class="text-muted">NISN: {{ $student->roll_number ?: '202600'.($idx+1) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="number" step="0.1" min="0" max="100" 
                                    name="grades[{{ $student->id }}][homework_score]" 
                                    class="form-control form-control-sm text-center score-input score-hw" 
                                    data-student="{{ $student->id }}"
                                    value="{{ $hw }}" placeholder="0-100">
                            </td>
                            <td>
                                <input type="number" step="0.1" min="0" max="100" 
                                    name="grades[{{ $student->id }}][quiz_score]" 
                                    class="form-control form-control-sm text-center score-input score-quiz" 
                                    data-student="{{ $student->id }}"
                                    value="{{ $quiz }}" placeholder="0-100">
                            </td>
                            <td>
                                <input type="number" step="0.1" min="0" max="100" 
                                    name="grades[{{ $student->id }}][midterm_score]" 
                                    class="form-control form-control-sm text-center score-input score-mid" 
                                    data-student="{{ $student->id }}"
                                    value="{{ $mid }}" placeholder="0-100">
                            </td>
                            <td>
                                <input type="number" step="0.1" min="0" max="100" 
                                    name="grades[{{ $student->id }}][final_exam_score]" 
                                    class="form-control form-control-sm text-center score-input score-uas" 
                                    data-student="{{ $student->id }}"
                                    value="{{ $uas }}" placeholder="0-100">
                            </td>
                            <td class="text-center">
                                <span class="fw-bold final-score-text text-dark" id="final-{{ $student->id }}">
                                    {{ $final !== '' ? number_format($final, 1) : '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill fw-bold grade-letter-badge bg-secondary" id="letter-{{ $student->id }}">
                                    {{ $letter }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill fw-bold status-badge {{ $passing === 1 ? 'bg-success' : ($passing === 0 ? 'bg-danger' : 'bg-light text-muted') }}" id="status-{{ $student->id }}">
                                    {{ $passing === 1 ? 'LULUS' : ($passing === 0 ? 'REMEDIAL' : '-') }}
                                </span>
                            </td>
                            <td class="pe-4">
                                <input type="text" name="grades[{{ $student->id }}][competency_notes]" 
                                    class="form-control form-control-sm" 
                                    value="{{ $notes }}" 
                                    placeholder="Catatan kemajuan siswa (opsional)...">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-user-xmark fs-3 d-block mb-2"></i>
                                Belum ada data siswa di kelas yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white py-3 px-4 border-top d-flex justify-content-between align-items-center">
            <span class="text-muted small">Keterangan: KKM = 75. Predikat A (>=90), B (>=80), C (>=75), D (<75).</span>
            <button type="submit" class="btn btn-success fw-bold px-4 shadow-sm" style="background-color: #198754;">
                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Semua Nilai (Batch Save)
            </button>
        </div>
    </div>
</form>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.score-input');

    function calculateRow(studentId) {
        const row = document.getElementById('row-' + studentId);
        if (!row) return;

        const hwInput = row.querySelector('.score-hw');
        const quizInput = row.querySelector('.score-quiz');
        const midInput = row.querySelector('.score-mid');
        const uasInput = row.querySelector('.score-uas');

        const hw = parseFloat(hwInput.value) || 0;
        const quiz = parseFloat(quizInput.value) || 0;
        const mid = parseFloat(midInput.value) || 0;
        const uas = parseFloat(uasInput.value) || 0;

        const hasAnyValue = hwInput.value !== '' || quizInput.value !== '' || midInput.value !== '' || uasInput.value !== '';

        const finalSpan = document.getElementById('final-' + studentId);
        const letterSpan = document.getElementById('letter-' + studentId);
        const statusSpan = document.getElementById('status-' + studentId);

        if (!hasAnyValue) {
            finalSpan.textContent = '-';
            letterSpan.textContent = '-';
            letterSpan.className = 'badge rounded-pill fw-bold grade-letter-badge bg-secondary';
            statusSpan.textContent = '-';
            statusSpan.className = 'badge rounded-pill fw-bold status-badge bg-light text-muted';
            return;
        }

        // Formula: 20% HW, 20% Quiz, 30% UTS, 30% UAS
        const finalScore = (hw * 0.20) + (quiz * 0.20) + (mid * 0.30) + (uas * 0.30);
        finalSpan.textContent = finalScore.toFixed(1);

        let letter = 'D';
        let badgeColor = 'bg-danger';
        if (finalScore >= 90) {
            letter = 'A';
            badgeColor = 'bg-success';
        } else if (finalScore >= 80) {
            letter = 'B';
            badgeColor = 'bg-primary';
        } else if (finalScore >= 75) {
            letter = 'C';
            badgeColor = 'bg-info text-dark';
        }

        letterSpan.textContent = letter;
        letterSpan.className = 'badge rounded-pill fw-bold grade-letter-badge ' + badgeColor;

        if (finalScore >= 75) {
            statusSpan.textContent = 'LULUS';
            statusSpan.className = 'badge rounded-pill fw-bold status-badge bg-success';
        } else {
            statusSpan.textContent = 'REMEDIAL';
            statusSpan.className = 'badge rounded-pill fw-bold status-badge bg-danger';
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            const studentId = this.dataset.student;
            calculateRow(studentId);
        });
    });

    // Initialize all existing rows
    @if(isset($students))
        @foreach($students as $s)
            calculateRow({{ $s->id }});
        @endforeach
    @endif
});
</script>
@endsection
