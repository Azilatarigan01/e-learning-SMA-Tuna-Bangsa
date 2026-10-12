@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user-shield fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 8: PERAN WALI KELAS (PRD BAB 6)
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Dashboard Kelas Binaan & Pembinaan Siswa</h3>
                        <p class="text-white-50 small mb-0">Pantau perkembangan holistik 40 siswa kelas binaan, catatan prestasi, karakter, dan konseling.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning text-dark fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addGuidanceModal">
                        <i class="fa-solid fa-plus me-1"></i> Catat Pembinaan / Prestasi
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

<!-- Filter Class -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('teacher.homeroom.index') }}" class="row g-3 align-items-center">
            <div class="col-md-6">
                <label class="form-label fw-semibold small mb-1">Pilih Kelas Binaan Anda</label>
                <select name="class_id" class="form-select" onchange="this.form.submit()">
                    @foreach($assignedClasses as $c)
                        <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                            {{ $c->name }} (40 Siswa)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 text-md-end pt-3 pt-md-0">
                <span class="badge bg-light text-dark border p-2">
                    <i class="fa-solid fa-user-tie text-danger me-1"></i> Wali Kelas: <strong>{{ Auth::user()->name }}</strong>
                </span>
            </div>
        </form>
    </div>
</div>

<!-- Homeroom Overview Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Jumlah Siswa Binaan</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $students->count() }} Siswa</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Lengkap 1 Kelas</span>
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
                    <h4 class="fw-bold mb-0 text-primary">{{ $classAvg ?: '-' }}</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Capaian Rapor Kelas</span>
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
                    <span class="text-muted small fw-semibold">Total Nilai Tuntas</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $totalPass }} Nilai</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">>= KKM (75.0)</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-circle-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #c59b27 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Catatan Pembinaan</span>
                    <h4 class="fw-bold mb-0 text-warning" style="color: #c59b27 !important;">{{ $guidances->count() }} Kasus</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Bimbingan & Prestasi</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-warning">
                    <i class="fa-solid fa-clipboard-list fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Nav Tabs for Students & Guidance History -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <ul class="nav nav-pills card-header-pills" id="homeroomTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-4" id="students-tab" data-bs-toggle="tab" data-bs-target="#students-pane" type="button" role="tab">
                    <i class="fa-solid fa-users me-2"></i> Daftar 40 Siswa Binaan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4" id="guidance-tab" data-bs-toggle="tab" data-bs-target="#guidance-pane" type="button" role="tab">
                    <i class="fa-solid fa-clipboard-check me-2"></i> Riwayat Pembinaan & Konseling ({{ $guidances->count() }})
                </button>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="homeroomTabContent">
        <!-- Tab 1: Daftar 40 Siswa -->
        <div class="tab-pane fade show active" id="students-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                    <thead style="background-color: #f8f9fa;">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th class="ps-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3">Nama Siswa & NISN</th>
                            <th class="py-3 text-center" style="width: 120px;">Jenis Kelamin</th>
                            <th class="py-3" style="width: 220px;">Email Akun</th>
                            <th class="py-3 text-center" style="width: 160px;">Status Pembinaan</th>
                            <th class="pe-4 py-3 text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $idx => $s)
                            @php
                                $sGuidanceCount = $guidances->where('student_id', $s->id)->count();
                            @endphp
                            <tr>
                                <td class="ps-4 text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width: 34px; height: 34px; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #851624;">
                                            {{ substr($s->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $s->name }}</div>
                                            <small class="text-muted">NISN: {{ $s->roll_number ?: '202600'.($idx+1) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-muted">
                                    {{ $s->gender == 'Male' || $s->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="small text-muted">{{ $s->email }}</td>
                                <td class="text-center">
                                    @if($sGuidanceCount > 0)
                                        <span class="badge bg-warning text-dark fw-bold">
                                            {{ $sGuidanceCount }} Catatan Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success fw-bold">
                                            Baik / Normal
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary fw-bold" onclick="openGuidanceForStudent({{ $s->id }}, '{{ addslashes($s->name) }}')">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Catat
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 2: Riwayat Catatan Pembinaan -->
        <div class="tab-pane fade" id="guidance-pane" role="tabpanel" tabindex="0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
                    <thead style="background-color: #f8f9fa;">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th class="ps-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3" style="width: 120px;">Tanggal</th>
                            <th class="py-3" style="min-width: 160px;">Nama Siswa</th>
                            <th class="py-3 text-center" style="width: 120px;">Kategori</th>
                            <th class="py-3" style="min-width: 250px;">Judul & Uraian Masalah/Apresiasi</th>
                            <th class="py-3" style="min-width: 200px;">Tindak Lanjut Wali Kelas</th>
                            <th class="pe-4 py-3 text-center" style="width: 140px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($guidances as $gIdx => $g)
                            <tr>
                                <td class="ps-4 text-center fw-bold text-muted">{{ $gIdx + 1 }}</td>
                                <td class="small text-muted">
                                    {{ date('d M Y', strtotime($g->date)) }}
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $g->student->name ?? 'Siswa' }}</div>
                                    <small class="text-muted">NISN: {{ $g->student->roll_number ?? '-' }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $g->category == 'Prestasi' ? 'bg-success' : ($g->category == 'Akademik' ? 'bg-primary' : ($g->category == 'Kedisiplinan' ? 'bg-danger' : 'bg-info text-dark')) }}">
                                        {{ $g->category }}
                                    </span>
                                </td>
                                <td>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ $g->title }}</h6>
                                    <p class="text-muted small mb-0">{{ $g->description }}</p>
                                </td>
                                <td class="small text-secondary">
                                    {{ $g->action_taken ?: 'Belum ada catatan tindak lanjut.' }}
                                </td>
                                <td class="pe-4 text-center">
                                    <span class="badge {{ $g->follow_up_status == 'Selesai' ? 'bg-success' : ($g->follow_up_status == 'Rujukan BK' ? 'bg-danger' : 'bg-warning text-dark') }} fw-bold">
                                        {{ $g->follow_up_status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-clipboard-check fs-2 d-block mb-2"></i>
                                    Belum ada catatan pembinaan atau konseling untuk kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Guidance Note -->
<div class="modal fade" id="addGuidanceModal" tabindex="-1" aria-labelledby="addGuidanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom py-3 px-4">
                <h6 class="modal-title fw-bold text-dark" id="addGuidanceModalLabel">
                    <i class="fa-solid fa-user-pen text-danger me-2"></i> Formulir Catatan Pembinaan & Apresiasi Siswa
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('teacher.homeroom.guidance') }}">
                @csrf
                <input type="hidden" name="class_id" value="{{ $selectedClassId }}">

                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Pilih Siswa <span class="text-danger">*</span></label>
                            <select name="student_id" id="guidanceStudentSelect" class="form-select" required>
                                <option value="">-- Pilih Siswa Binaan --</option>
                                @foreach($students as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }} (NISN: {{ $st->roll_number }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kategori Bimbingan <span class="text-danger">*</span></label>
                            <select name="category" class="form-select" required>
                                <option value="Akademik">Akademik (Remedial / Kendala Belajar)</option>
                                <option value="Prestasi">Prestasi (Lomba / Penghargaan Karakter)</option>
                                <option value="Kedisiplinan">Kedisiplinan (Keterlambatan / Seragam)</option>
                                <option value="Karakter">Karakter & Sosial (Sikap / Kerjasama)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tanggal Catatan <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Status Tindak Lanjut <span class="text-danger">*</span></label>
                            <select name="follow_up_status" class="form-select" required>
                                <option value="Selesai">Selesai (Sudah Diberi Solusi/Apresiasi)</option>
                                <option value="Dalam Pemantauan">Dalam Pemantauan Wali Kelas</option>
                                <option value="Rujukan BK">Perlu Rujukan Guru BK / Konseling</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Judul Catatan <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Contoh: Bimbingan Peningkatan Nilai Fisika & Kedisiplinan KBM">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Uraian / Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="3" required placeholder="Jelaskan secara objektif perkembangan atau kendala yang dialami siswa..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Tindakan / Solusi yang Diberikan Wali Kelas</label>
                            <textarea name="action_taken" class="form-control" rows="2" placeholder="Contoh: Diskusi santai empat mata, koordinasi dengan guru mapel, dan pemberian modul latihan mandiri..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-4">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="background-color: #851624; border-color: #851624;">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Catatan Pembinaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openGuidanceForStudent(studentId, studentName) {
    document.getElementById('guidanceStudentSelect').value = studentId;
    const modal = new bootstrap.Modal(document.getElementById('addGuidanceModal'));
    modal.show();
}
</script>
@endsection
