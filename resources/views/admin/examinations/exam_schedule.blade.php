@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-warning fs-5"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Jadwal Ujian CBT (Exam Schedule)</h5>
                        <small class="text-white-50">Pengaturan waktu, tanggal pelaksanaan, dan ruangan ujian</small>
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
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Filter Toolbar -->
                <div class="card bg-light border-0 p-3 mb-4 rounded-4" style="background-color: #fbf9f6 !important;">
                    <form action="{{ route('exam_schedule') }}" method="GET">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-muted mb-1">Pilih Ujian CBT</label>
                                <select class="form-select" name="exam_id" id="exam_id" required>
                                    <option value="">-- Pilih Ujian --</option>
                                    @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->id) ? 'selected':'' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-muted mb-1">Pilih Rombongan Kelas</label>
                                <select class="form-select" name="class_id" id="class_id" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="fa-solid fa-magnifying-glass me-1"></i> Tampilkan
                                </button>
                                <a href="{{ route('exam_schedule') }}" class="btn btn-secondary px-3" title="Reset filter">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                @if (!empty($getRecord))
                    <form action="{{ route('exam_schedule_insert') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="fa-solid fa-pen-ruler me-2 text-danger"></i> Atur Jadwal Mata Pelajaran
                            </h6>
                            <span class="badge bg-primary">Total {{ count($getRecord) }} Mapel</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" style="width: 25%;">Nama Mata Pelajaran</th>
                                        <th scope="col" style="width: 20%;">Tanggal Ujian</th>
                                        <th scope="col" style="width: 18%;">Jam Mulai</th>
                                        <th scope="col" style="width: 18%;">Jam Selesai</th>
                                        <th scope="col" style="width: 19%;">Nomor Ruang / Lab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <td>
                                                <span class="fw-bold text-dark fs-6">{{ $value['subject_name'] }}</span>
                                                <input type="hidden" value="{{ $value['subject_id'] }}" name="schedule[{{ $i }}][subject_id]">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" value="{{ $value['exam_date'] }}" name="schedule[{{ $i }}][exam_date]">
                                            </td>
                                            <td>
                                                <input type="time" class="form-control" value="{{ $value['start_time'] }}" name="schedule[{{ $i }}][start_time]">
                                            </td>
                                            <td>
                                                <input type="time" class="form-control" value="{{ $value['end_time'] }}" name="schedule[{{ $i }}][end_time]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Contoh: Lab Komputer 1" value="{{ $value['room_number'] }}" name="schedule[{{ $i }}][room_number]">
                                            </td>
                                        </tr> 
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Jadwal Ujian
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
