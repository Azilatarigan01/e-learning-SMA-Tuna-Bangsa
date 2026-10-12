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
                            PORTAL ORANG TUA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Capaian Nilai & Rapor Digital Anak</h3>
                        <p class="text-white-50 small mb-0">Hasil asesmen akademik resmi anak Anda: <strong>{{ $student->name ?? 'Siswa' }}</strong> • {{ $class->name ?? 'Kelas' }}</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-print me-1"></i> Cetak Rapor Anak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grades Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-list-check text-primary"></i> Daftar Nilai Capaian Kompetensi (KKM = 75.0)
        </h6>
        <span class="badge bg-secondary rounded-pill">{{ $grades->count() }} Mata Pelajaran</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3" style="width: 50px;">No</th>
                    <th class="py-3">Mata Pelajaran & Guru Pengampu</th>
                    <th class="py-3 text-center" style="width: 80px;">KKM</th>
                    <th class="py-3 text-center" style="width: 80px;">Tugas</th>
                    <th class="py-3 text-center" style="width: 80px;">Kuis</th>
                    <th class="py-3 text-center" style="width: 80px;">UTS</th>
                    <th class="py-3 text-center" style="width: 80px;">UAS</th>
                    <th class="py-3 text-center" style="width: 100px;">Nilai Akhir</th>
                    <th class="py-3 text-center" style="width: 80px;">Predikat</th>
                    <th class="py-3 text-center" style="width: 100px;">Status</th>
                    <th class="pe-4 py-3">Catatan Perkembangan Guru</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $idx => $g)
                    <tr>
                        <td class="ps-4 text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $g->subjectModel->name ?? '-' }}</div>
                            <small class="text-muted">{{ $g->teacher->name ?? '-' }}</small>
                        </td>
                        <td class="text-center fw-semibold">75</td>
                        <td class="text-center">{{ $g->homework_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->quiz_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->midterm_score ?? '-' }}</td>
                        <td class="text-center">{{ $g->final_exam_score ?? '-' }}</td>
                        <td class="text-center fw-bold fs-6 text-dark">{{ number_format($g->final_score, 1) }}</td>
                        <td class="text-center">
                            <span class="badge {{ $g->grade_letter == 'A' ? 'bg-success' : ($g->grade_letter == 'B' ? 'bg-primary' : ($g->grade_letter == 'C' ? 'bg-info text-dark' : 'bg-danger')) }}">
                                {{ $g->grade_letter }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $g->passing_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $g->passing_status == 1 ? 'LULUS' : 'REMEDIAL' }}
                            </span>
                        </td>
                        <td class="pe-4 small text-muted">
                            {{ $g->competency_notes ?: 'Tuntas dan memenuhi kriteria ketuntasan minimal.' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center py-5 text-muted">Belum ada nilai yang diterbitkan untuk siswa ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
