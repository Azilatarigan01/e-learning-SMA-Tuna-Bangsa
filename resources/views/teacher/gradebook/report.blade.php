@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-trophy fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            REKAPITULASI & RANKING
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Laporan & Peringkat Kelas</h3>
                        <p class="text-white-50 small mb-0">Lihat rekap perolehan nilai, ranking kelas 1 - 40, serta distribusi predikat capaian belajar siswa.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('teacher.gradebook.index', ['class_id' => $selectedClassId, 'subject_id' => $selectedSubjectId]) }}" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Input Nilai
                    </a>
                    <button onclick="window.print()" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-print me-1"></i> Cetak Leger / PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Selection -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('teacher.gradebook.report') }}" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small mb-1">Pilih Kelas</label>
                        <select name="class_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small mb-1">Pilih Mata Pelajaran</label>
                        <select name="subject_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-sm btn-primary w-100 fw-bold" style="background-color: #851624; border-color: #851624;">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($grades->isNotEmpty())
<!-- Statistics Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Total Dinilai</span>
            <h4 class="fw-bold mb-0 text-dark">{{ $grades->count() }}</h4>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Rata-rata Kelas</span>
            <h4 class="fw-bold mb-0 text-primary">{{ round($grades->avg('final_score'), 1) }}</h4>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Nilai Tertinggi</span>
            <h4 class="fw-bold mb-0 text-success">{{ round($grades->max('final_score'), 1) }}</h4>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Nilai Terendah</span>
            <h4 class="fw-bold mb-0 text-danger">{{ round($grades->min('final_score'), 1) }}</h4>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Predikat A & B</span>
            <h4 class="fw-bold mb-0 text-success">
                {{ $grades->whereIn('grade_letter', ['A', 'B'])->count() }}
            </h4>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 14px;">
            <span class="text-muted small">Remedial (< 75)</span>
            <h4 class="fw-bold mb-0 text-danger">
                {{ $grades->where('passing_status', 0)->count() }}
            </h4>
        </div>
    </div>
</div>

<!-- Ranking Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-ranking-star text-warning"></i> Urutan Peringkat Nilai Siswa (Tertinggi ke Terendah)
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3 text-center" style="width: 80px;">Rank</th>
                    <th class="py-3">Nama Siswa</th>
                    <th class="py-3 text-center" style="width: 100px;">Tugas</th>
                    <th class="py-3 text-center" style="width: 100px;">Kuis</th>
                    <th class="py-3 text-center" style="width: 100px;">UTS</th>
                    <th class="py-3 text-center" style="width: 100px;">UAS</th>
                    <th class="py-3 text-center" style="width: 110px;">Nilai Akhir</th>
                    <th class="py-3 text-center" style="width: 90px;">Predikat</th>
                    <th class="py-3 text-center" style="width: 110px;">Status</th>
                    <th class="pe-4 py-3">Catatan Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $rank => $g)
                    <tr>
                        <td class="ps-4 text-center">
                            @if($rank == 0)
                                <span class="badge rounded-circle p-2 text-dark fw-bold" style="background-color: #ffd700; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-crown text-dark"></i>
                                </span>
                            @elseif($rank == 1)
                                <span class="badge rounded-circle p-2 text-dark fw-bold" style="background-color: #c0c0c0; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                    2
                                </span>
                            @elseif($rank == 2)
                                <span class="badge rounded-circle p-2 text-white fw-bold" style="background-color: #cd7f32; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                    3
                                </span>
                            @else
                                <span class="fw-bold text-muted">{{ $rank + 1 }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $g->student->name ?? 'Siswa' }}</div>
                            <small class="text-muted">NISN: {{ $g->student->roll_number ?? '-' }}</small>
                        </td>
                        <td class="text-center">{{ $g->homework_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->quiz_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->midterm_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->final_exam_score ?? '-' }}</td>
                        <td class="text-center">
                            <span class="fw-bold fs-6 text-dark">{{ number_format($g->final_score, 1) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill fw-bold {{ $g->grade_letter == 'A' ? 'bg-success' : ($g->grade_letter == 'B' ? 'bg-primary' : ($g->grade_letter == 'C' ? 'bg-info text-dark' : 'bg-danger')) }}">
                                {{ $g->grade_letter }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill fw-bold {{ $g->passing_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $g->passing_status == 1 ? 'LULUS' : 'REMEDIAL' }}
                            </span>
                        </td>
                        <td class="pe-4 text-muted small">
                            {{ $g->competency_notes ?: '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
    <div class="my-4">
        <i class="fa-solid fa-clipboard-list fs-1 text-muted mb-3 d-block"></i>
        <h5 class="fw-bold text-dark">Belum ada nilai yang diinput untuk kelas ini</h5>
        <p class="text-muted small">Silakan masuk ke menu Input Nilai untuk mengisi asesmen 40 siswa di kelas ini.</p>
        <a href="{{ route('teacher.gradebook.index', ['class_id' => $selectedClassId, 'subject_id' => $selectedSubjectId]) }}" class="btn btn-warning text-dark fw-bold px-4">
            <i class="fa-solid fa-pen-to-square me-1"></i> Mulai Input Nilai
        </a>
    </div>
</div>
@endif

@endsection
