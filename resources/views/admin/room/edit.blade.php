@extends('layouts.app')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Edit Data Ruangan / Fasilitas</h5>
                </div>
                <a href="{{ url('admin/room/list') }}" class="btn btn-sm btn-outline-light px-3">
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
                <form method="POST" action="{{ url('admin/room/update', $getRecord->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold">Nama Ruangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="Contoh: Ruang X MIPA 1..." value="{{ old('name', $getRecord->name) }}">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold">Tipe Ruangan <span class="text-danger">*</span></label>
                            <select class="form-select" name="type" required>
                                <option value="Kelas Teori" {{ $getRecord->type == 'Kelas Teori' ? 'selected' : '' }}>Kelas Teori</option>
                                <option value="Laboratorium Komputer" {{ $getRecord->type == 'Laboratorium Komputer' ? 'selected' : '' }}>Laboratorium Komputer</option>
                                <option value="Laboratorium Sains/IPA" {{ $getRecord->type == 'Laboratorium Sains/IPA' ? 'selected' : '' }}>Laboratorium Sains/IPA</option>
                                <option value="Lapangan Olahraga" {{ $getRecord->type == 'Lapangan Olahraga' ? 'selected' : '' }}>Lapangan Olahraga</option>
                                <option value="Aula Serbaguna" {{ $getRecord->type == 'Aula Serbaguna' ? 'selected' : '' }}>Aula Serbaguna</option>
                                <option value="Perpustakaan" {{ $getRecord->type == 'Perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                                <option value="Ruang Ekstrakurikuler" {{ $getRecord->type == 'Ruang Ekstrakurikuler' ? 'selected' : '' }}>Ruang Ekstrakurikuler</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kapasitas Maksimal (Siswa/Kursi) <span class="text-danger">*</span></label>
                            <input type="number" min="1" max="1000" class="form-control" name="capacity" required value="{{ old('capacity', $getRecord->capacity) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status Kesiapan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" required>
                                <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Tersedia & Siap Dipakai</option>
                                <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Dalam Perbaikan (Maintenance)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Catatan & Fasilitas Tambahan</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Contoh: Dilengkapi proyektor infocus, AC...">{{ old('notes', $getRecord->notes) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ url('admin/room/list') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
