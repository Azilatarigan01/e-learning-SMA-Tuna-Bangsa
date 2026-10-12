@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-clipboard-user fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            PORTAL ORANG TUA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Riwayat Presensi & Kehadiran Anak</h3>
                        <p class="text-white-50 small mb-0">Catatan kehadiran belajar harian di sekolah untuk: <strong>{{ $student->name ?? 'Siswa' }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Logs Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-calendar-check text-success"></i> Log Presensi KBM di Kelas
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-secondary small fw-bold text-uppercase">
                    <th class="ps-4 py-3" style="width: 50px;">No</th>
                    <th class="py-3" style="width: 130px;">Tanggal</th>
                    <th class="py-3">Mata Pelajaran</th>
                    <th class="py-3">Guru Pengampu</th>
                    <th class="py-3 text-center" style="width: 140px;">Status Kehadiran</th>
                    <th class="pe-4 py-3">Keterangan / Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $idx => $a)
                    <tr>
                        <td class="ps-4 text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                        <td class="text-muted small">
                            <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($a->attendance_date)) }}
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $a->subjectModel->name ?? '-' }}</div>
                        </td>
                        <td class="small text-muted">{{ $a->teacher->name ?? '-' }}</td>
                        <td class="text-center">
                            @if($a->attendance_status == 1)
                                <span class="badge bg-success fw-bold px-3 py-1">HADIR</span>
                            @elseif($a->attendance_status == 2)
                                <span class="badge bg-info text-dark fw-bold px-3 py-1">IZIN</span>
                            @elseif($a->attendance_status == 3)
                                <span class="badge bg-warning text-dark fw-bold px-3 py-1">SAKIT</span>
                            @else
                                <span class="badge bg-danger fw-bold px-3 py-1">ALPA</span>
                            @endif
                        </td>
                        <td class="pe-4 small text-muted">
                            {{ $a->notes ?: '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada catatan presensi untuk siswa ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($attendances, 'hasPages') && $attendances->hasPages())
    <div class="card-footer bg-white py-3 px-4 border-top">
        {{ $attendances->links() }}
    </div>
    @endif
</div>
@endsection
