@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-laptop-code text-warning fs-5"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Jadwal Ujian CBT Saya (My Exam Timetable)</h5>
                        <small class="text-white-50">Jadwal resmi pelaksanaan ujian semester dan simulasi</small>
                    </div>
                </div>
                <span class="badge" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 215, 0, 0.4); font-size: 11px;">
                    <i class="fa-solid fa-clock me-1"></i> Waktu Indonesia Barat
                </span>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(count($getRecord) > 0)
                    @foreach ($getRecord as $value)
                    <div class="p-3 mb-4 rounded-4" style="background: #fbf9f6; border: 1px solid #ede8e3;">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="fa-solid fa-file-signature me-2 text-danger"></i> {{ $value['name'] }}
                            </h6>
                            <span class="badge bg-primary">Jadwal Ujian Terjadwal</span>
                        </div>
                        <div class="table-responsive bg-white rounded-3 shadow-sm">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col" class="text-center">Hari</th>
                                        <th scope="col" class="text-center">Tanggal Ujian</th>
                                        <th scope="col" class="text-center">Jam Mulai</th>
                                        <th scope="col" class="text-center">Jam Selesai</th>
                                        <th scope="col" class="text-center">Ruang / Lab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($value['exam'] as $valueS)
                                        <tr>
                                            <td>
                                                <span class="fw-bold text-dark fs-6">{{ $valueS['subject_name'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge" style="background: #fbecee; color: #851624; font-weight: 700;">
                                                    {{ date('l', strtotime($valueS['exam_date'])) }}
                                                </span>
                                            </td>
                                            <td class="text-center text-muted small">
                                                <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($valueS['exam_date'])) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700; padding: 5px 12px;">
                                                    {{ date('H:i', strtotime($valueS['start_time'])) }} WIB
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700; padding: 5px 12px;">
                                                    {{ date('H:i', strtotime($valueS['end_time'])) }} WIB
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">
                                                    <i class="fa-solid fa-door-open me-1"></i> {{ $valueS['room_number'] ?? 'Lab CBT' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-calendar-xmark fa-2x mb-2 d-block text-secondary"></i>
                        Belum ada jadwal ujian CBT aktif untuk kelas Anda saat ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
