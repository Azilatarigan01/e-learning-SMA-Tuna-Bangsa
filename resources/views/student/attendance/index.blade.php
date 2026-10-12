@extends('layouts.app')

@section('container')
<!-- Header Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user-check fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            DISIPLIN & PRESENSI KBM
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Riwayat Kehadiran Siswa</h3>
                        <p class="text-white-50 small mb-0">Pantau akumulasi kehadiran, sakit, izin, dan alpa Anda pada setiap mata pelajaran di SMA Tuna Bangsa.</p>
                    </div>
                </div>
                <div class="text-end">
                    <div class="small text-white-50">Tingkat Kehadiran Saya</div>
                    <div class="fs-4 fw-bold text-warning">{{ $summary['percentage'] }}%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stat Metric Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white;">
            <div class="small text-muted fw-bold text-uppercase">Total Sesi</div>
            <h3 class="fw-bold mb-0 text-dark">{{ $summary['total'] }}</h3>
            <small class="text-muted">Pertemuan</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #198754 !important;">
            <div class="small text-muted fw-bold text-uppercase text-success">Hadir</div>
            <h3 class="fw-bold mb-0 text-success">{{ $summary['hadir'] }}</h3>
            <small class="text-muted">Sesi</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #ffc107 !important;">
            <div class="small text-muted fw-bold text-uppercase text-warning">Sakit</div>
            <h3 class="fw-bold mb-0 text-warning">{{ $summary['sakit'] }}</h3>
            <small class="text-muted">Hari</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #0dcaf0 !important;">
            <div class="small text-muted fw-bold text-uppercase text-info">Izin</div>
            <h3 class="fw-bold mb-0 text-info">{{ $summary['izin'] }}</h3>
            <small class="text-muted">Hari</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white; border-bottom: 3px solid #dc3545 !important;">
            <div class="small text-muted fw-bold text-uppercase text-danger">Alpa</div>
            <h3 class="fw-bold mb-0 text-danger">{{ $summary['alpa'] }}</h3>
            <small class="text-muted">Hari</small>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm text-center p-3" style="border-radius: 14px; background: white;">
            <div class="small text-muted fw-bold text-uppercase">Persentase</div>
            <h3 class="fw-bold mb-0 {{ $summary['percentage'] >= 85 ? 'text-success' : 'text-danger' }}">
                {{ $summary['percentage'] }}%
            </h3>
            <small class="text-muted">Syarat Min 80%</small>
        </div>
    </div>
</div>

<!-- Filter Mapel -->
@if(!empty($getSubject) && $getSubject->count() > 0)
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="fw-semibold text-dark small">
                    <i class="fa-solid fa-filter text-primary me-1"></i> Filter Mata Pelajaran:
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('student/my_attendance') }}" class="btn btn-sm {{ !Request::get('subject_id') ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                        Semua Mapel
                    </a>
                    @foreach($getSubject as $sub)
                        <a href="{{ url('student/my_attendance') }}?subject_id={{ $sub->subject_id }}" class="btn btn-sm {{ Request::get('subject_id') == $sub->subject_id ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                            {{ $sub->subject_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- History Table -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-warning"></i> Riwayat Presensi Detail ({{ $history->count() }} Pertemuan)
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Tanggal KBM</th>
                                <th scope="col" class="text-center">Sesi / Pertemuan</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Guru Pengajar</th>
                                <th scope="col" class="text-center" style="width: 140px;">Status Kehadiran</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $rec)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold text-dark">
                                        <i class="fa-regular fa-calendar-days text-muted me-1"></i>
                                        {{ date('d M Y', strtotime($rec->attendance_date)) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">
                                        {{ $rec->meeting_number }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">
                                        {{ !empty($rec->subjectModel) ? $rec->subjectModel->name : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="small text-muted fw-semibold">
                                        {{ !empty($rec->teacher) ? $rec->teacher->name : '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($rec->attendance_status == 1)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Hadir
                                        </span>
                                    @elseif($rec->attendance_status == 2)
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-notes-medical me-1"></i> Sakit
                                        </span>
                                    @elseif($rec->attendance_status == 3)
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
                                        {{ !empty($rec->notes) ? $rec->notes : '—' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada catatan presensi yang terekam.
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
