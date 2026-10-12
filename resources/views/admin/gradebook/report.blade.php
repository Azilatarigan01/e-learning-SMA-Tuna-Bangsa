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
                            TAHAP 6: MASTER BUKU NILAI & LEGER
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Buku Nilai & Leger Akademik Sekolah</h3>
                        <p class="text-white-50 small mb-0">Pantau seluruh catatan asesmen nilai siswa dari 12 rombongan kelas (480 siswa) dan 26 dewan guru.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('master_leger.print', $selectedClassId ?: 17) }}" target="_blank" class="btn btn-warning text-dark fw-bold px-3 shadow-sm">
                        <i class="fa-solid fa-file-pdf me-1"></i> Format Cetak Leger Resmi (A4)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overall Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Entri Nilai</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ number_format($overallStats['total_entries']) }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Data asesmen tersimpan</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-database fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Rata-rata Sekolah</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $overallStats['overall_avg'] ?: '-' }}</h4>
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
                    <span class="text-muted small fw-semibold">Nilai Tuntas</span>
                    <h4 class="fw-bold mb-0 text-success">{{ number_format($overallStats['total_pass']) }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Memenuhi standar KKM</span>
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
                    <span class="text-muted small fw-semibold">Remedial Siswa</span>
                    <h4 class="fw-bold mb-0 text-danger">{{ number_format($overallStats['total_remedial']) }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Perlu evaluasi perbaikan</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-circle-exclamation fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Box -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-sliders text-danger"></i> Filter Leger Nilai Siswa
        </h6>
    </div>
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.gradebook.report') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Filter Kelas / Rombel</label>
                <select name="class_id" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">-- Semua Kelas (12 Rombel) --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Filter Mata Pelajaran</label>
                <select name="subject_id" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">-- Semua Mata Pelajaran --</option>
                    @foreach($subjects as $s)
                        <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold w-100 py-2 shadow-sm" style="background-color: #851624; border-color: #851624;">
                    <i class="fa-solid fa-filter me-1"></i> Terapkan Filter
                </button>
                <a href="{{ route('admin.gradebook.report') }}" class="btn btn-light border fw-semibold px-3 py-2">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Master Leger Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-table-list text-primary"></i> Master Leger Nilai Siswa
        </h6>
        <span class="badge bg-secondary rounded-pill">{{ $grades->total() }} Data Ditemukan</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3" style="width: 50px;">No</th>
                    <th class="py-3">Nama Siswa & NISN</th>
                    <th class="py-3">Kelas</th>
                    <th class="py-3">Mata Pelajaran</th>
                    <th class="py-3">Guru Pengampu</th>
                    <th class="py-3 text-center" style="width: 70px;">Tugas</th>
                    <th class="py-3 text-center" style="width: 70px;">Kuis</th>
                    <th class="py-3 text-center" style="width: 70px;">UTS</th>
                    <th class="py-3 text-center" style="width: 70px;">UAS</th>
                    <th class="py-3 text-center" style="width: 90px;">Nilai Akhir</th>
                    <th class="py-3 text-center" style="width: 70px;">Predikat</th>
                    <th class="pe-4 py-3 text-center" style="width: 90px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $idx => $g)
                    <tr>
                        <td class="ps-4 text-center fw-bold text-muted">{{ $grades->firstItem() + $idx }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $g->student->name ?? 'Siswa' }}</div>
                            <small class="text-muted">NISN: {{ $g->student->roll_number ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $g->classModel->name ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $g->subjectModel->name ?? '-' }}</div>
                        </td>
                        <td class="small text-muted">{{ $g->teacher->name ?? '-' }}</td>
                        <td class="text-center">{{ $g->homework_score !== null ? $g->homework_score : '-' }}</td>
                        <td class="text-center">{{ $g->quiz_score !== null ? $g->quiz_score : '-' }}</td>
                        <td class="text-center">{{ $g->midterm_score !== null ? $g->midterm_score : '-' }}</td>
                        <td class="text-center">{{ $g->final_exam_score !== null ? $g->final_exam_score : '-' }}</td>
                        <td class="text-center fw-bold fs-6 {{ $g->final_score >= 75 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($g->final_score, 1) }}
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill fw-bold {{ $g->grade_letter == 'A' ? 'bg-success' : ($g->grade_letter == 'B' ? 'bg-primary' : ($g->grade_letter == 'C' ? 'bg-info text-dark' : 'bg-danger')) }}">
                                {{ $g->grade_letter }}
                            </span>
                        </td>
                        <td class="pe-4 text-center">
                            <span class="badge rounded-pill fw-bold {{ $g->passing_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $g->passing_status == 1 ? 'LULUS' : 'REMEDIAL' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fs-3 d-block mb-2"></i>
                            Tidak ada data leger nilai yang cocok dengan filter yang dipilih.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($grades->hasPages())
    <div class="card-footer bg-white py-3 px-4 border-top">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Menampilkan {{ $grades->firstItem() }} - {{ $grades->lastItem() }} dari {{ $grades->total() }} entri</small>
            <div>
                {{ $grades->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
