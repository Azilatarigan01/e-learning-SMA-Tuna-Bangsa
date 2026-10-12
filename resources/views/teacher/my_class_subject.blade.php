@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-chalkboard-user text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Kelas & Mata Pelajaran Saya (Teacher Assignment)</h5>
                </div>
                <span class="badge" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 215, 0, 0.4); font-size: 11px;">
                    <i class="fa-solid fa-school me-1"></i> Penugasan Guru Aktif
                </span>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 60px;">No</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col" class="text-center">Tipe / Kategori</th>
                                <th scope="col" class="text-center">Tanggal Penugasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecords as $record)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge" style="background: #fbecee; color: #851624; border: 1px solid #ecc9cf; font-weight: 700; padding: 6px 12px; font-size: 12.5px;">
                                        <i class="fa-solid fa-users-rectangle me-1"></i> {{ $record->class_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $record->subject_name }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700; padding: 6px 12px;">
                                        {{ $record->subject_type }}
                                    </span>
                                </td>
                                <td class="text-center text-muted small">
                                    <i class="fa-regular fa-calendar-check me-1"></i>
                                    {{ $record->created_at ? $record->created_at->format('d M Y') : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data penugasan kelas dan mapel untuk Anda.
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
