@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-hands-holding-child fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 9: PORTAL ORANG TUA (PRD BAB 3 & 11)
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Selamat Datang, Bapak/Ibu {{ $parent->name }}</h3>
                        <p class="text-white-50 small mb-0">Pantau perkembangan belajar, kehadiran, jadwal, dan pengumuman putra/putri Anda secara transparan.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('parent.my_student_grades') }}" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Lihat Rapor Anak
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($student)
<!-- Child Identity Card -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; background: white;">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: #fdf2f2; border: 2px solid #851624; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #851624; font-size: 1.2rem;">
                    {{ substr($student->name, 0, 1) }}
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">{{ $student->name }}</h5>
                    <span class="text-muted small">NISN: {{ $student->roll_number ?: '202600123' }} • Kelas: <strong>{{ $class->name ?? 'X MIPA 1' }}</strong> (SMA Tuna Bangsa)</span>
                </div>
            </div>
            <div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fw-bold">
                    <i class="fa-solid fa-circle-check me-1"></i> Siswa Aktif TP 2026/2027
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Child Overview Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Rata-rata Nilai</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $stats['gpa'] ?: '-' }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Dari {{ $stats['total_subjects'] }} Mapel</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-award fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #198754 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Tingkat Kehadiran</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['attendance_rate'] }}%</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Hadir: {{ $stats['present_count'] }} Hari</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-user-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Sakit / Izin</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $stats['sick_count'] + $stats['permission_count'] }} Hari</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Tercatat dengan keterangan</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-primary">
                    <i class="fa-solid fa-notes-medical fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #dc3545 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Alpa / Tanpa Ket.</span>
                    <h4 class="fw-bold mb-0 {{ $stats['absent_count'] > 0 ? 'text-danger' : 'text-muted' }}">{{ $stats['absent_count'] }} Hari</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Ketertiban disiplin</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-circle-exclamation fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Academic Grades Summary Table -->
    <div class="col-lg-7 col-12">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-book-open-reader text-danger"></i> Nilai Capaian Belajar Semester
                </h6>
                <a href="{{ route('parent.my_student_grades') }}" class="small fw-bold text-danger text-decoration-none">
                    Lihat Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                    <thead style="background-color: #f8f9fa;">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th class="ps-4 py-3">Mata Pelajaran</th>
                            <th class="py-3 text-center">Tugas</th>
                            <th class="py-3 text-center">UTS</th>
                            <th class="py-3 text-center">UAS</th>
                            <th class="py-3 text-center">Nilai Akhir</th>
                            <th class="pe-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades->take(6) as $g)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $g->subjectModel->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $g->teacher->name ?? 'Guru Pengampu' }}</small>
                                </td>
                                <td class="text-center">{{ $g->homework_score ?? '-' }}</td>
                                <td class="text-center">{{ $g->midterm_score ?? '-' }}</td>
                                <td class="text-center">{{ $g->final_exam_score ?? '-' }}</td>
                                <td class="text-center fw-bold text-dark">{{ number_format($g->final_score, 1) }}</td>
                                <td class="pe-4 text-center">
                                    <span class="badge {{ $g->passing_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $g->passing_status == 1 ? 'LULUS' : 'REMEDIAL' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data nilai yang diinput.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- School Notices Widget -->
    <div class="col-lg-5 col-12">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; overflow: hidden;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-bullhorn text-warning"></i> Pengumuman Sekolah
                </h6>
                <a href="{{ route('parent.notice_board') }}" class="small fw-bold text-danger text-decoration-none">
                    Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-4 d-flex flex-column gap-3">
                @forelse($notices as $n)
                    <div class="p-3 rounded-3 border" style="background-color: #fafafa;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="badge {{ $n->priority == 'urgent' ? 'bg-danger' : 'bg-secondary' }} fw-bold" style="font-size: 0.7rem;">
                                {{ strtoupper($n->priority) }}
                            </span>
                            <small class="text-muted">{{ date('d M Y', strtotime($n->notice_date)) }}</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ $n->title }}</h6>
                        <p class="text-muted small mb-0">{{ Str::limit($n->message, 80) }}</p>
                    </div>
                @empty
                    <p class="text-muted small text-center my-4">Tidak ada pengumuman terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@else
<div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
    <i class="fa-solid fa-user-xmark fs-1 text-muted mb-3 d-block"></i>
    <h5 class="fw-bold text-dark">Belum ada data siswa yang dihubungkan ke akun Anda</h5>
    <p class="text-muted small">Silakan hubungi administrator sekolah untuk menghubungkan akun orang tua dengan siswa.</p>
</div>
@endif

@endsection
