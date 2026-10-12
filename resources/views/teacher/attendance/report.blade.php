@extends('layouts.app')

@section('container')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-chart-column fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            REKAPITULASI KEHADIRAN
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Laporan & Persentase Kehadiran Kelas</h3>
                        <p class="text-white-50 small mb-0">Pantau tingkat kehadiran, sakit, izin, dan alpa siswa untuk evaluasi pembelajaran dan syarat kelulusan.</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('teacher.attendance.take') }}" class="btn btn-warning text-dark fw-bold px-3">
                        <i class="fa-solid fa-clipboard-user me-1"></i> Input Presensi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('teacher.attendance.report') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small">Pilih Kelas / Rombel <span class="text-danger">*</span></label>
                        <select name="class_id" class="form-select" required onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($getClass as $c)
                                <option value="{{ $c->id }}" {{ $class_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small">Pilih Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="subject_id" class="form-select" required onchange="this.form.submit()">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @if(!empty($getSubject))
                                @foreach($getSubject as $s)
                                    <option value="{{ $s->subject_id }}" {{ $subject_id == $s->subject_id ? 'selected' : '' }}>
                                        {{ $s->subject_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="fa-solid fa-filter me-1"></i> Tampilkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Report Table -->
@if(!empty($studentsReport) && count($studentsReport) > 0)
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fa-solid fa-list-check text-warning"></i> Rekapitulasi Presensi Siswa ({{ count($studentsReport) }} Siswa)
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col" class="text-center" style="width: 90px;">No. Absen</th>
                                <th scope="col">Nama Lengkap Siswa</th>
                                <th scope="col" class="text-center">Total Sesi</th>
                                <th scope="col" class="text-center text-success">Hadir</th>
                                <th scope="col" class="text-center text-warning">Sakit</th>
                                <th scope="col" class="text-center text-info">Izin</th>
                                <th scope="col" class="text-center text-danger">Alpa</th>
                                <th scope="col" class="text-center" style="width: 150px;">Persentase</th>
                                <th scope="col" class="text-center">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentsReport as $row)
                            @php
                                $s = $row['student'];
                                $sum = $row['summary'];
                                $pct = $sum['percentage'];
                            @endphp
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                        #{{ $s->roll_number ?? $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $s->name }}</div>
                                    <small class="text-muted">NISN: {{ $s->admission_number ?? '-' }}</small>
                                </td>
                                <td class="text-center fw-bold text-dark">{{ $sum['total'] }}</td>
                                <td class="text-center fw-bold text-success">{{ $sum['hadir'] }}</td>
                                <td class="text-center fw-bold text-warning">{{ $sum['sakit'] }}</td>
                                <td class="text-center fw-bold text-info">{{ $sum['izin'] }}</td>
                                <td class="text-center fw-bold text-danger">{{ $sum['alpa'] }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px; border-radius: 10px;">
                                            <div class="progress-bar {{ $pct >= 85 ? 'bg-success' : ($pct >= 75 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $pct }}%;"></div>
                                        </div>
                                        <span class="fw-bold small {{ $pct >= 85 ? 'text-success' : ($pct >= 75 ? 'text-warning' : 'text-danger') }}">{{ $pct }}%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($pct >= 90)
                                        <span class="badge bg-success px-3 py-1 rounded-pill">Sangat Baik</span>
                                    @elseif($pct >= 80)
                                        <span class="badge bg-primary px-3 py-1 rounded-pill">Baik</span>
                                    @elseif($pct >= 75)
                                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Cukup</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-1 rounded-pill">Perlu Perhatian</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
