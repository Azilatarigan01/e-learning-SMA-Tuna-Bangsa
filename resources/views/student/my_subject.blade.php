@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-book-open text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Mata Pelajaran Saya (My Subjects)</h5>
                </div>
                <span class="badge" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 215, 0, 0.4); font-size: 11px;">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Kurikulum Merdeka
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
                                <th scope="col" class="text-center" style="width: 70px;">No</th>
                                <th scope="col">Nama Mata Pelajaran</th>
                                <th scope="col" class="text-center" style="width: 220px;">Tipe / Bidang Studi</th>
                                <th scope="col" class="text-center" style="width: 160px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecords as $record)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 38px; height: 38px; border-radius: 10px; background: #fbecee; color: #851624; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                                            <i class="fa-solid fa-book"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $record->subject_name }}</span>
                                            <span class="text-muted small">SMA Tuna Bangsa</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge" style="background: #fef8e7; color: #b8860b; border: 1px solid #f9e7be; font-weight: 700; padding: 6px 14px;">
                                        <i class="fa-solid fa-layer-group me-1"></i> {{ $record->subject_type }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check me-1"></i> Terdaftar
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada mata pelajaran yang terdaftar untuk akun Anda.
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
