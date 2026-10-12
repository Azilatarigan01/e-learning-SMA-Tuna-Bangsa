@extends('layouts.app')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Edit Tahun Ajaran & Semester</h5>
                </div>
                <a href="{{ url('admin/academic_year/list') }}" class="btn btn-sm btn-outline-light px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                <form method="POST" action="{{ url('admin/academic_year/update', $getRecord->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="Contoh: 2026/2027" value="{{ old('name', $getRecord->name) }}">
                            <small class="text-muted">Format: TTTT/TTTT</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                            <select class="form-select" name="semester" required>
                                <option value="Ganjil" {{ $getRecord->semester == 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                <option value="Genap" {{ $getRecord->semester == 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Mulai Semester</label>
                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $getRecord->start_date) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Berakhir Semester</label>
                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $getRecord->end_date) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status Penggunaan <span class="text-danger">*</span></label>
                        <select class="form-select" name="is_active">
                            <option value="1" {{ $getRecord->is_active == 1 ? 'selected' : '' }}>Jadikan Semester Aktif Utama (Berjalan Sekarang)</option>
                            <option value="0" {{ $getRecord->is_active == 0 ? 'selected' : '' }}>Non-Aktif / Diarsipkan</option>
                        </select>
                        @if($getRecord->is_active == 1)
                            <div class="alert alert-info mt-2 py-2 px-3 small d-flex align-items-center gap-2 mb-0">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Saat ini sedang aktif sebagai semester berjalan.</span>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ url('admin/academic_year/list') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
