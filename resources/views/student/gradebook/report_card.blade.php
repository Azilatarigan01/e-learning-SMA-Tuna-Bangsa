@extends('layouts.app')

@section('container')
<style>
@media print {
    .no-print {
        display: none !important;
    }
    body {
        background: white !important;
    }
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>

<!-- Top Actions (No Print) -->
<div class="row mb-4 no-print">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-graduation-cap fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 6: RAPOR RESMI SISWA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Rapor Akademik Digital Siswa</h3>
                        <p class="text-white-50 small mb-0">Laporan capaian hasil belajar semester resmi SMA Tuna Bangsa Tahun Pelajaran 2026/2027.</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('report_card.print') }}" target="_blank" class="btn btn-warning text-dark fw-bold px-4 shadow-sm">
                        <i class="fa-solid fa-file-pdf me-1"></i> Format Cetak Resmi (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Official Report Card Document -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; background: white;">
    <!-- School Header / Kop Surat -->
    <div class="p-4 border-bottom text-center" style="background: linear-gradient(to bottom, #fafafa, #ffffff);">
        <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
            <div style="width: 54px; height: 54px; border-radius: 12px; background: #851624; color: #ffd700; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: bold; border: 2px solid #ffd700;">
                TB
            </div>
            <div>
                <h4 class="fw-bold mb-0 text-dark" style="letter-spacing: 0.5px;">SMA SWASTA TUNA BANGSA</h4>
                <p class="text-muted small mb-0">Jl. Kapten Muslim No. 99, Medan Helvetia | Terakreditasi A (Unggul)</p>
                <small class="text-muted">NPSN: 10203040 | NSS: 301020304050 | info@tunabangsa.sch.id</small>
            </div>
        </div>
        <hr class="my-3" style="border-top: 2px solid #851624; opacity: 0.8;">
        <h5 class="fw-bold text-uppercase mb-1" style="color: #851624; letter-spacing: 1px;">
            LAPORAN CAPAIAN KOMPETENSI PESERTA DIDIK
        </h5>
        <span class="badge bg-light text-dark border px-3 py-1 fw-bold">SEMESTER GANJIL - TAHUN PELAJARAN 2026/2027</span>
    </div>

    <!-- Student Bio Grid -->
    <div class="p-4 border-bottom bg-light bg-opacity-50">
        <div class="row g-3">
            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0" style="font-size: 0.9rem;">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Nama Siswa</td>
                        <td class="fw-bold text-dark">: {{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Induk / NISN</td>
                        <td class="fw-bold text-dark">: {{ $student->roll_number ?: '202600123' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kelas / Rombel</td>
                        <td class="fw-bold text-dark">: {{ $class->name ?? 'X MIPA 1' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0" style="font-size: 0.9rem;">
                    <tr>
                        <td class="text-muted" style="width: 140px;">Sekolah</td>
                        <td class="fw-bold text-dark">: SMA Tuna Bangsa</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Ajaran</td>
                        <td class="fw-bold text-dark">: 2026/2027 (Ganjil)</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Kelulusan</td>
                        <td>: 
                            @if($stats['remedial_count'] == 0 && $stats['total_subjects'] > 0)
                                <span class="badge bg-success fw-bold">TUNTAS / LULUS SEMUA MAPEL</span>
                            @elseif($stats['total_subjects'] > 0)
                                <span class="badge bg-warning text-dark fw-bold">TERDAPAT {{ $stats['remedial_count'] }} MAPEL REMEDIAL</span>
                            @else
                                <span class="badge bg-secondary fw-bold">DALAM PROSES ASESMEN</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Summary Statistics Pills (No Print) -->
    <div class="p-4 border-bottom no-print">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 text-center" style="border-radius: 12px;">
                    <span class="text-muted small">Rata-rata Nilai Rapor</span>
                    <h3 class="fw-bold mb-0 text-primary">{{ $stats['gpa'] ?: '-' }}</h3>
                    <small class="text-muted">Skala 100</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 text-center" style="border-radius: 12px;">
                    <span class="text-muted small">Mata Pelajaran Tuntas</span>
                    <h3 class="fw-bold mb-0 text-success">{{ $stats['passed_count'] }} / {{ $stats['total_subjects'] }}</h3>
                    <small class="text-success fw-bold">KKM Minimum: 75.0</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 text-center" style="border-radius: 12px;">
                    <span class="text-muted small">Predikat Sangat Baik (A)</span>
                    <h3 class="fw-bold mb-0 text-warning" style="color: #c59b27 !important;">{{ $stats['grade_counts']['A'] }} Mapel</h3>
                    <small class="text-muted">Nilai >= 90</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-light p-3 text-center" style="border-radius: 12px;">
                    <span class="text-muted small">Mata Pelajaran Remedial</span>
                    <h3 class="fw-bold mb-0 {{ $stats['remedial_count'] > 0 ? 'text-danger' : 'text-muted' }}">{{ $stats['remedial_count'] }} Mapel</h3>
                    <small class="text-muted">{{ $stats['remedial_count'] > 0 ? 'Perlu Remidial' : 'Nir Remedial' }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="p-4">
        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
            <i class="fa-solid fa-list-check" style="color: #851624;"></i> DAFTAR NILAI CAPAIAN AKADEMIK
        </h6>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0" style="font-size: 0.88rem;">
                <thead style="background-color: #851624; color: white;">
                    <tr class="text-center">
                        <th rowspan="2" style="width: 40px; vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: left;">Mata Pelajaran & Guru Pengampu</th>
                        <th rowspan="2" style="width: 60px; vertical-align: middle;">KKM</th>
                        <th colspan="4" class="text-center py-1">Komponen Asesmen</th>
                        <th rowspan="2" style="width: 80px; vertical-align: middle;">Nilai Akhir</th>
                        <th rowspan="2" style="width: 70px; vertical-align: middle;">Predikat</th>
                        <th rowspan="2" style="width: 85px; vertical-align: middle;">Keterangan</th>
                        <th rowspan="2" style="vertical-align: middle; min-width: 200px;">Deskripsi Capaian Kompetensi</th>
                    </tr>
                    <tr class="text-center" style="font-size: 0.8rem; background-color: #680e1a;">
                        <th style="width: 65px;">Tugas (20%)</th>
                        <th style="width: 65px;">Kuis (20%)</th>
                        <th style="width: 65px;">UTS (30%)</th>
                        <th style="width: 65px;">UAS (30%)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $idx => $g)
                        <tr>
                            <td class="text-center fw-bold">{{ $idx + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $g->subjectModel->name ?? 'Mata Pelajaran' }}</div>
                                <small class="text-muted d-block">Guru: {{ $g->teacher->name ?? 'Guru Pengampu' }}</small>
                            </td>
                            <td class="text-center fw-semibold">75</td>
                            <td class="text-center">{{ $g->homework_score !== null ? $g->homework_score : '-' }}</td>
                            <td class="text-center">{{ $g->quiz_score !== null ? $g->quiz_score : '-' }}</td>
                            <td class="text-center">{{ $g->midterm_score !== null ? $g->midterm_score : '-' }}</td>
                            <td class="text-center">{{ $g->final_exam_score !== null ? $g->final_exam_score : '-' }}</td>
                            <td class="text-center fw-bold fs-6 {{ $g->final_score >= 75 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($g->final_score, 1) }}
                            </td>
                            <td class="text-center fw-bold">
                                <span class="badge {{ $g->grade_letter == 'A' ? 'bg-success' : ($g->grade_letter == 'B' ? 'bg-primary' : ($g->grade_letter == 'C' ? 'bg-info text-dark' : 'bg-danger')) }}">
                                    {{ $g->grade_letter }}
                                </span>
                            </td>
                            <td class="text-center fw-bold">
                                <span class="badge {{ $g->passing_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $g->passing_status == 1 ? 'TUNTAS' : 'REMEDIAL' }}
                                </span>
                            </td>
                            <td class="small text-muted">
                                {{ $g->competency_notes ?: 'Menunjukkan penguasaan materi yang baik dan tuntas sesuai capaian pembelajaran.' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-file-invoice fs-3 d-block mb-2"></i>
                                Belum ada nilai yang diinput oleh guru untuk siswa ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Grade Scale Legend -->
        <div class="mt-3 p-3 bg-light rounded" style="font-size: 0.8rem;">
            <div class="row">
                <div class="col-md-6">
                    <span class="fw-bold text-dark">Kriteria Ketuntasan Minimal (KKM): 75.0</span><br>
                    <span>Formula Penilaian: (20% x Tugas) + (20% x Kuis/Formatif) + (30% x UTS) + (30% x UAS)</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="fw-bold">Interval Predikat:</span>
                    <span class="badge bg-success ms-1">A : 90 - 100</span>
                    <span class="badge bg-primary ms-1">B : 80 - 89.9</span>
                    <span class="badge bg-info text-dark ms-1">C : 75 - 79.9</span>
                    <span class="badge bg-danger ms-1">D : < 75 (Remedial)</span>
                </div>
            </div>
        </div>

        <!-- Official Signatures -->
        <div class="mt-5 pt-3">
            <div class="row text-center" style="font-size: 0.9rem;">
                <div class="col-4">
                    <p class="mb-1 text-muted">Mengetahui,</p>
                    <p class="fw-bold text-dark mb-5">Orang Tua / Wali Siswa</p>
                    <div style="height: 40px;"></div>
                    <p class="fw-bold text-dark mb-0">( ........................................ )</p>
                </div>
                <div class="col-4">
                    <p class="mb-1 text-muted">Medan, 12 Oktober 2026</p>
                    <p class="fw-bold text-dark mb-5">Wali Kelas</p>
                    <div style="height: 40px;"></div>
                    <p class="fw-bold text-dark mb-0">Drs. Hendra Setiawan, M.Pd.</p>
                    <small class="text-muted">NIP. 19780512 200312 1 004</small>
                </div>
                <div class="col-4">
                    <p class="mb-1 text-muted">Kepala Sekolah,</p>
                    <p class="fw-bold text-dark mb-5">SMA Swasta Tuna Bangsa</p>
                    <div style="height: 40px;"></div>
                    <p class="fw-bold text-dark mb-0">Dr. H. Ahmad Fauzi, M.Ed.</p>
                    <small class="text-muted">NIP. 19690815 199403 1 002</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
