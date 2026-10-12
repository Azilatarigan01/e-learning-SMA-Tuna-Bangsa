@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-users-rectangle text-warning fs-5"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Siswa Bimbingan & Kelas Ajar Saya</h5>
                        <small class="text-white-50">Daftar siswa yang berada pada rombongan kelas yang Anda ampu</small>
                    </div>
                </div>
                <span class="badge" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 215, 0, 0.4); font-size: 11px;">
                    <i class="fa-solid fa-chalkboard-user me-1"></i> Guru Pengajar
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
                                <th scope="col" class="text-center" style="width: 70px;">Foto</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">NISN / No. Induk</th>
                                <th scope="col">Kelas Binaan</th>
                                <th scope="col">Email Akun</th>
                                <th scope="col" class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            @forelse ($getRecords as $record)
                            <tr>
                                <td class="text-center">
                                    @if($record->profile_pic)
                                        <img src="{{ asset('uploads/profile_pics/' . $record->profile_pic) }}" alt="{{ $record->name }}" class="lms-avatar">
                                    @else
                                        <div class="lms-avatar-placeholder mx-auto">
                                            {{ strtoupper(substr($record->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark fs-6">{{ $record->name }}</div>
                                    <small class="text-muted">SMA Tuna Bangsa</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary">
                                        <i class="fa-solid fa-id-badge me-1 text-muted"></i> {{ $record->roll_number ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" style="background: #fbecee; color: #851624; border: 1px solid #ecc9cf; font-weight: 700; padding: 6px 12px;">
                                        <i class="fa-solid fa-school me-1"></i> {{ $record->class_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold">
                                        <i class="fa-regular fa-envelope me-1 text-muted"></i> {{ $record->email }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn-action-detail" data-bs-toggle="modal" data-bs-target="#studentModal{{ $record->id }}">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-graduation-cap fa-2x mb-2 d-block text-secondary"></i>
                                    Belum ada data siswa pada kelas ajar Anda.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Modal Detail Siswa -->
                @foreach ($getRecords as $record)
                <div class="modal fade" id="studentModal{{ $record->id }}" tabindex="-1" aria-labelledby="studentModalLabel{{ $record->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="studentModalLabel{{ $record->id }}">
                                    <i class="fa-solid fa-id-card me-2"></i> Profil Siswa Bimbingan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-3 mb-md-0">
                                        @if($record->profile_pic)
                                            <img src="{{ asset('uploads/profile_pics/' . $record->profile_pic) }}" alt="{{ $record->name }}" class="rounded-4 img-fluid shadow-sm" style="max-height: 220px; object-fit: cover;">
                                        @else
                                            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 140px; height: 140px; font-size: 48px; color: #851624; font-weight: 800;">
                                                {{ strtoupper(substr($record->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <h6 class="fw-bold mt-3 mb-1">{{ $record->name }}</h6>
                                        <span class="badge bg-primary">{{ $record->class_name }}</span>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-sm border-0 mb-0">
                                            <tr>
                                                <th class="text-muted fw-bold" style="width: 35%;">NISN</th>
                                                <td class="text-dark fw-semibold">: {{ $record->roll_number ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted fw-bold">Email</th>
                                                <td class="text-dark fw-semibold">: {{ $record->email }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted fw-bold">Jenis Kelamin</th>
                                                <td class="text-dark fw-semibold">: {{ $record->gender ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted fw-bold">Tanggal Lahir</th>
                                                <td class="text-dark fw-semibold">: {{ $record->date_of_birth ? date('d M Y', strtotime($record->date_of_birth)) : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted fw-bold">No. Handphone</th>
                                                <td class="text-dark fw-semibold">: {{ $record->mobile_number ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted fw-bold">Kelas</th>
                                                <td class="text-dark fw-semibold">: {{ $record->class_name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
