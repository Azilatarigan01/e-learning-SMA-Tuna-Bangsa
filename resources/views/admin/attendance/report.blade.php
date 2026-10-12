@extends('layouts.app')

@section('container')
<!-- Header Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-clipboard-check fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            MONITORING DISIPLIN SEKOLAH
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Rekapitulasi Presensi & Kehadiran Sekolah</h3>
                        <p class="text-white-50 small mb-0">Pemantauan seluruh catatan kehadiran kegiatan belajar mengajar SMA Tuna Bangsa.</p>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill fs-6">
                        <i class="fa-solid fa-check-double text-warning me-1"></i> Rata-rata Kehadiran: {{ $stats['persen'] }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white;">
            <div class="small text-muted fw-bold text-uppercase">Total Rekaman</div>
            <h3 class="fw-bold mb-0 text-dark">{{ $stats['total'] }}</h3>
            <small class="text-muted">Data Presensi</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #198754 !important;">
            <div class="small text-muted fw-bold text-uppercase text-success">Total Hadir</div>
            <h3 class="fw-bold mb-0 text-success">{{ $stats['hadir'] }}</h3>
            <small class="text-muted">Siswa</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #ffc107 !important;">
            <div class="small text-muted fw-bold text-uppercase text-warning">Total Sakit</div>
            <h3 class="fw-bold mb-0 text-warning">{{ $stats['sakit'] }}</h3>
            <small class="text-muted">Siswa</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #0dcaf0 !important;">
            <div class="small text-muted fw-bold text-uppercase text-info">Total Izin</div>
            <h3 class="fw-bold mb-0 text-info">{{ $stats['izin'] }}</h3>
            <small class="text-muted">Siswa</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #dc3545 !important;">
            <div class="small text-muted fw-bold text-uppercase text-danger">Total Alpa</div>
            <h3 class="fw-bold mb-0 text-danger">{{ $stats['alpa'] }}</h3>
            <small class="text-muted">Siswa</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white;">
            <div class="small text-muted fw-bold text-uppercase">Persentase</div>
            <h3 class="fw-bold mb-0 {{ $stats['persen'] >= 85 ? 'text-success' : 'text-danger' }}">
                {{ $stats['persen'] }}%
            </h3>
            <small class="text-muted">Target Disiplin</small>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('admin.attendance.report') }}" class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <select name="class_id" class="form-select">
                            <option value="">-- Semua Kelas / Rombel --</option>
                            @foreach($getClass as $c)
                                <option value="{{ $c->id }}" {{ Request::get('class_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="subject_id" class="form-select">
                            <option value="">-- Semua Mata Pelajaran --</option>
                            @foreach($getSubject as $s)
                                <option value="{{ $s->id }}" {{ Request::get('subject_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="attendance_date" class="form-control" value="{{ Request::get('attendance_date') }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.attendance.report') }}" class="btn btn-outline-secondary" title="Reset">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Report Table -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fa-solid fa-list-check text-warning"></i> Data Catatan Presensi Sekolah ({{ $getRecord->count() }} Data)
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Tanggal & Sesi</th>
                                <th scope="col">Siswa</th>
                                <th scope="col">Kelas & Mapel</th>
                                <th scope="col">Guru Pengajar</th>
                                <th scope="col" class="text-center" style="width: 140px;">Status</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ date('d M Y', strtotime($row->attendance_date)) }}</div>
                                    <small class="badge bg-light text-dark border">{{ $row->meeting_number }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ !empty($row->student) ? $row->student->name : '-' }}</div>
                                    <small class="text-muted">NISN: {{ !empty($row->student) ? $row->student->admission_number : '-' }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ !empty($row->classModel) ? $row->classModel->name : '-' }}</div>
                                    <small class="badge bg-light text-secondary border px-2 py-0">
                                        {{ !empty($row->subjectModel) ? $row->subjectModel->name : '-' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="small text-muted fw-semibold">
                                        {{ !empty($row->teacher) ? $row->teacher->name : '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($row->attendance_status == 1)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Hadir
                                        </span>
                                    @elseif($row->attendance_status == 2)
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-notes-medical me-1"></i> Sakit
                                        </span>
                                    @elseif($row->attendance_status == 3)
                                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-envelope-open-text me-1"></i> Izin
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Alpa
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ !empty($row->notes) ? $row->notes : '—' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data presensi yang sesuai dengan filter.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
