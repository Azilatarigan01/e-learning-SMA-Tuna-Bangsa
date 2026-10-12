@extends('layouts.app')

@section('container')
<div class="row mb-4">
    <div class="col-12">
        @php
            $activeYear = $getRecord->firstWhere('is_active', 1);
        @endphp
        @if($activeYear)
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
                <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 54px; height: 54px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-calendar-check fs-3 text-warning"></i>
                        </div>
                        <div>
                            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                                <i class="fa-solid fa-award me-1"></i> SEMESTER BERJALAN AKTIF
                            </span>
                            <h3 class="fw-bold mb-0 text-white">{{ $activeYear->name }} — Semester {{ $activeYear->semester }}</h3>
                            <div class="text-white-50 small mt-1">
                                <i class="fa-regular fa-calendar-days me-1 text-warning"></i>
                                Periode: 
                                {{ !empty($activeYear->start_date) ? date('d M Y', strtotime($activeYear->start_date)) : 'Tanggal belum diatur' }} 
                                &nbsp;s/d&nbsp; 
                                {{ !empty($activeYear->end_date) ? date('d M Y', strtotime($activeYear->end_date)) : 'Tanggal belum diatur' }}
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success bg-opacity-75 px-3 py-2 rounded-pill fs-6">
                            <i class="fa-solid fa-circle-check me-1"></i> Sedang Digunakan oleh Seluruh Rombel & KBM
                        </span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-week text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Master Tahun Ajaran & Semester SMA Tuna Bangsa</h5>
                </div>
                <a href="{{ url('admin/academic_year/add') }}" class="btn btn-sm btn-warning text-dark fw-bold px-3">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Tahun Ajaran
                </a>
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

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col" class="text-center">Semester</th>
                                <th scope="col">Rentang Waktu / Periode</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center" style="width: 260px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecord as $record)
                            <tr class="{{ $record->is_active == 1 ? 'table-light' : '' }}">
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="lms-avatar" style="width: 38px; height: 38px; font-size: 0.9rem; background: {{ $record->is_active == 1 ? 'linear-gradient(135deg, #851624, #c59b27)' : '#f0f0f0' }}; color: {{ $record->is_active == 1 ? '#fff' : '#666' }};">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark fs-6">{{ $record->name }}</div>
                                            <small class="text-muted">ID TA: #{{ $record->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($record->semester == 'Ganjil')
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-notch me-1"></i> Semester Ganjil
                                        </span>
                                    @else
                                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-notch me-1"></i> Semester Genap
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($record->start_date) && !empty($record->end_date))
                                        <span class="small text-dark fw-semibold">
                                            <i class="fa-regular fa-calendar-check text-muted me-1"></i>
                                            {{ date('d M Y', strtotime($record->start_date)) }} — {{ date('d M Y', strtotime($record->end_date)) }}
                                        </span>
                                    @else
                                        <span class="text-muted small italic">Belum ditentukan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($record->is_active == 1)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Sedang Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill text-white">
                                            <i class="fa-solid fa-pause me-1"></i> Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        @if($record->is_active != 1)
                                            <a href="{{ url('admin/academic_year/set_active', $record->id) }}" class="btn btn-sm btn-outline-success px-2" title="Jadikan semester aktif" onclick="return confirm('Aktifkan semester {{ $record->name }} ({{ $record->semester }}) sebagai semester utama?')">
                                                <i class="fa-solid fa-check-double me-1"></i> Aktifkan
                                            </a>
                                        @endif
                                        <a href="{{ url('admin/academic_year/edit', $record->id) }}" class="btn btn-sm btn-primary px-3">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </a>
                                        @if($record->is_active != 1)
                                            <form action="{{ route('admin.academic_year.delete', $record->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tahun ajaran ini?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger px-2">
                                                    <i class="fa-solid fa-trash me-1"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data tahun ajaran dan semester yang terdaftar.
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
