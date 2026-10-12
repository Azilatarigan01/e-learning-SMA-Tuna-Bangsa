@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-laptop-code text-warning fs-5"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Daftar Ujian CBT (Examinations)</h5>
                        <small class="text-white-50">Manajemen bank ujian dan evaluasi daring SMA Tuna Bangsa</small>
                    </div>
                </div>
                <a href="{{ route('exam_add') }}" class="btn btn-sm btn-warning text-dark fw-bold px-3">
                    <i class="fa-solid fa-plus me-1"></i> Buat Ujian Baru
                </a>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Filter Toolbar -->
                <div class="card bg-light border-0 p-3 mb-4 rounded-4" style="background-color: #fbf9f6 !important;">
                    <form action="{{ route('exam_list') }}" method="GET">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label for="exam_name" class="form-label small fw-bold text-muted mb-1">Cari Nama Ujian</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                    <input type="text" id="exam_name" class="form-control border-start-0" value="{{ Request::get('exam_name') }}" name="exam_name" placeholder="Misal: Ujian Tengah Semester...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="created_date" class="form-label small fw-bold text-muted mb-1">Tanggal Dibuat</label>
                                <input type="date" id="created_date" class="form-control" value="{{ Request::get('created_date') }}" name="created_date">
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="fa-solid fa-filter me-1"></i> Filter
                                </button>
                                <a href="{{ route('exam_list') }}" class="btn btn-secondary px-3" title="Reset filter">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Nama Ujian</th>
                                <th scope="col">Catatan / Deskripsi</th>
                                <th scope="col">Dibuat Oleh</th>
                                <th scope="col" class="text-center">Tanggal Dibuat</th>
                                <th scope="col" class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecords as $record)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-bold text-dark fs-6">{{ $record->name }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small">{{ $record->note ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700;">
                                        <i class="fa-solid fa-user-pen me-1"></i> {{ $record->created_name }}
                                    </span>
                                </td>
                                <td class="text-center text-muted small">
                                    <i class="fa-regular fa-calendar-check me-1"></i> {{ $record->created_at->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('exam_edit', $record->id) }}" class="btn-action-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('exam_delete', $record->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ujian ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-laptop-file fa-2x mb-2 d-block text-secondary"></i>
                                    Belum ada data ujian yang dibuat.
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
