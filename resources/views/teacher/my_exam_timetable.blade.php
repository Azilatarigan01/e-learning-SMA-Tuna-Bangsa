@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-warning fs-5"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Jadwal Mengajar & Pengawas Ujian Guru</h5>
                        <small class="text-white-50">Jadwal pelaksanaan CBT untuk kelas bimbingan Anda</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (count($getRecord) > 0)
                    @foreach ($getRecord as $class)
                        <div class="p-3 mb-4 rounded-4" style="background: #fbf9f6; border: 1px solid #ede8e3;">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge" style="background: #851624; color: #ffffff; padding: 6px 14px; font-size: 13px;">
                                        <i class="fa-solid fa-school me-1"></i> Kelas: {{ $class['class_name'] }}
                                    </span>
                                </div>
                            </div>

                            @foreach ($class['exam'] as $exam)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-dark mb-2">
                                        <i class="fa-solid fa-file-lines me-2 text-warning"></i> {{ $exam['exam_name'] }}
                                    </h6>
                                    <div class="table-responsive bg-white rounded-3 shadow-sm">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col" class="text-center">Hari</th>
                                                    <th scope="col" class="text-center">Tanggal Ujian</th>
                                                    <th scope="col" class="text-center">Jam Pelaksanaan</th>
                                                    <th scope="col" class="text-center">Ruang / Lab</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($exam['subject'] as $subject)
                                                    <tr>
                                                        <td>
                                                            <span class="fw-bold text-dark">{{ $subject['subject_name'] }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge" style="background: #fbecee; color: #851624; font-weight: 700;">
                                                                {{ date('l', strtotime($subject['exam_date'])) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center text-muted small">
                                                            <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($subject['exam_date'])) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700; padding: 5px 12px;">
                                                                <i class="fa-regular fa-clock me-1"></i> {{ date('H:i', strtotime($subject['start_time'])) }} - {{ date('H:i', strtotime($subject['end_time'])) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-secondary">
                                                                <i class="fa-solid fa-door-open me-1"></i> {{ $subject['room_number'] ?? 'Ruang Kelas' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-calendar-xmark fa-2x mb-2 d-block text-secondary"></i>
                        Belum ada jadwal ujian CBT aktif saat ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
