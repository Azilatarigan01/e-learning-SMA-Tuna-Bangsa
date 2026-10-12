@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-file-signature"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-tasks mr-1"></i> Penugasan Belajar
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Daftar Tugas & Homework Sekolah
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Monitoring penugasan siswa di seluruh rombongan belajar dan tenggat waktu pengumpulan tugas.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('admin.homework.add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-plus-circle mr-1"></i> Buat Tugas Baru
                        </a>
                    </div>
                </div>
            </div>

            @include('_message')
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff; overflow: hidden;">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-clipboard-list mr-2" style="color: #851624;"></i> Daftar Tugas Siswa
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($getRecord) }} Tugas
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">No</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Rombel Kelas</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Mata Pelajaran</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Tanggal Diberikan</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Batas Waktu (Deadline)</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Lampiran</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 240px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $value)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2; color: #851624; border: 1px solid #fed7d7; border-radius: 10px; font-size: 0.85rem;">
                                            {{ $value->class_name }}
                                        </span>
                                    </td>
                                    <td class="py-3 font-weight-bold text-dark">
                                        {{ $value->subject_name }}
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        <i class="far fa-calendar mr-1"></i> {{ date('d M Y', strtotime($value->homework_date)) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2d2; color: #8a6508; border: 1px solid #fce2a6; border-radius: 10px; font-size: 0.82rem;">
                                            <i class="far fa-clock mr-1"></i> {{ date('d M Y', strtotime($value->submission_date)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        @if(!empty($value->getDocument()))
                                            <a href="{{ $value->getDocument() }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" download>
                                                <i class="fas fa-download mr-1"></i> Unduh
                                            </a>
                                        @else
                                            <span class="text-muted small">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="d-inline-flex">
                                            <a href="{{ url('admin/homework/submitted/'.$value->id) }}" class="btn btn-sm btn-outline-success mr-1" style="border-radius: 8px;" title="Lihat Siswa yang Mengumpulkan">
                                                <i class="fas fa-users"></i> Jawaban Siswa
                                            </a>
                                            <a href="{{ url('admin/homework/edit/'.$value->id) }}" class="btn btn-sm btn-outline-primary mr-1" style="border-radius: 8px;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ url('admin/homework/delete/'.$value->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-file-pen mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mb-0">Belum ada tugas yang dibuat.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
