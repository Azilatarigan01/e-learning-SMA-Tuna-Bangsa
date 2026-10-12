@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-id-card-clip fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 8: BIMBINGAN & KONSELING SEKOLAH
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Rekap Pembinaan & Bimbingan Siswa Sekolah</h3>
                        <p class="text-white-50 small mb-0">Pantau catatan pembinaan karakter, prestasi, kedisiplinan, dan rujukan BK dari seluruh 12 wali kelas (PRD Bab 6).</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-print me-1"></i> Cetak Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #851624 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Catatan Pembinaan</span>
                    <h4 class="fw-bold mb-0 text-dark">{{ $stats['total_notes'] }} Catatan</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Seluruh 12 rombel</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-clipboard-list fs-4" style="color: #851624;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #198754 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Catatan Prestasi</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $stats['achievement_notes'] }} Siswa</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Apresiasi bakat & lomba</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-success">
                    <i class="fa-solid fa-trophy fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #0d6efd !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Bimbingan Akademik</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $stats['academic_notes'] }} Kasus</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Pendampingan belajar</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-primary">
                    <i class="fa-solid fa-book-open-reader fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; border-left: 4px solid #dc3545 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Rujukan Guru BK</span>
                    <h4 class="fw-bold mb-0 text-danger">{{ $stats['counseling_referrals'] }} Siswa</h4>
                    <span class="text-muted" style="font-size: 0.8rem;">Perlu bimbingan intensif</span>
                </div>
                <div class="p-3 rounded-circle bg-light text-danger">
                    <i class="fa-solid fa-headset fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.homeroom.report') }}" class="row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold small mb-1">Filter Berdasarkan Rombongan Kelas</label>
                <select name="class_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Seluruh Kelas (12 Rombel) --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ $selectedClassId == $c->id ? 'selected' : '' }}>
                            {{ $c->name }} (40 Siswa)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end gap-2">
                <a href="{{ route('admin.homeroom.report') }}" class="btn btn-light border">Reset Filter</a>
            </div>
        </form>
    </div>
</div>

<!-- Guidance Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-list-check text-primary"></i> Rekapitulasi Catatan Pembinaan Siswa
        </h6>
        <span class="badge bg-secondary rounded-pill">{{ $guidances->total() }} Data Ditemukan</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3" style="width: 50px;">No</th>
                    <th class="py-3" style="width: 110px;">Tanggal</th>
                    <th class="py-3" style="min-width: 180px;">Siswa & NISN</th>
                    <th class="py-3" style="width: 120px;">Kelas</th>
                    <th class="py-3" style="width: 160px;">Wali Kelas</th>
                    <th class="py-3 text-center" style="width: 120px;">Kategori</th>
                    <th class="py-3" style="min-width: 240px;">Judul & Uraian Catatan</th>
                    <th class="pe-4 py-3 text-center" style="width: 140px;">Status Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guidances as $idx => $g)
                    <tr>
                        <td class="ps-4 text-center fw-bold text-muted">{{ $guidances->firstItem() + $idx }}</td>
                        <td class="small text-muted">{{ date('d M Y', strtotime($g->date)) }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $g->student->name ?? 'Siswa' }}</div>
                            <small class="text-muted">NISN: {{ $g->student->roll_number ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $g->classModel->name ?? '-' }}</span>
                        </td>
                        <td class="small text-muted">
                            <i class="fa-solid fa-user-tie me-1"></i> {{ $g->homeroomTeacher->name ?? 'Wali Kelas' }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $g->category == 'Prestasi' ? 'bg-success' : ($g->category == 'Akademik' ? 'bg-primary' : ($g->category == 'Kedisiplinan' ? 'bg-danger' : 'bg-info text-dark')) }}">
                                {{ $g->category }}
                            </span>
                        </td>
                        <td>
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">{{ $g->title }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($g->description, 100) }}</p>
                        </td>
                        <td class="pe-4 text-center">
                            <span class="badge {{ $g->follow_up_status == 'Selesai' ? 'bg-success' : ($g->follow_up_status == 'Rujukan BK' ? 'bg-danger' : 'bg-warning text-dark') }} fw-bold">
                                {{ $g->follow_up_status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-clipboard-check fs-2 d-block mb-2"></i>
                            Tidak ada catatan pembinaan yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($guidances->hasPages())
    <div class="card-footer bg-white py-3 px-4 border-top">
        {{ $guidances->links() }}
    </div>
    @endif
</div>
@endsection
