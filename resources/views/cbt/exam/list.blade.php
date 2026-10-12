@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-desktop mr-1"></i> Computer-Based Test (CBT)
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Manajemen Paket Ujian & Kuis Online
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Atur jadwal pelaksanaan ujian CBT, durasi waktu pengerjaan otomatis, dan pantau rekap skor siswa secara realtime.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.exams.add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-plus-circle mr-1"></i> Buat Paket Ujian Baru
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
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="font-weight-bold mb-0 text-dark">
                        <i class="fas fa-tasks mr-2" style="color: #851624;"></i> Daftar Paket Ujian & Kuis
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($exams) }} Paket Ujian
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 60px;">No</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Nama Ujian / Kuis</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Target Kelas</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Mata Pelajaran</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Durasi</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Jumlah Soal</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">KKM</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Status</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($exams as $e)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <div class="font-weight-bold text-dark" style="font-size: 0.95rem;">{{ $e->title }}</div>
                                        <small class="text-muted"><i class="fas fa-user-tie mr-1"></i> {{ $e->teacher->name ?? 'Admin Sekolah' }}</small>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge badge-light border px-2 py-1 font-weight-bold text-dark" style="border-radius: 8px;">
                                            {{ $e->classModel->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <span class="font-weight-bold" style="color: #851624;">
                                            {{ $e->subject->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge badge-warning text-dark font-weight-bold px-2 py-1" style="background: #fdf0cd; border-radius: 8px;">
                                            <i class="far fa-clock mr-1"></i> {{ $e->duration_minutes }} Menit
                                        </span>
                                    </td>
                                    <td class="py-3 text-center font-weight-bold">
                                        {{ count($e->examQuestions) }} Butir
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge badge-info px-2 py-1 font-weight-bold" style="border-radius: 8px;">
                                            {{ $e->passing_grade }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge badge-success px-2 py-1" style="border-radius: 10px; font-size: 0.78rem;">
                                            <i class="fas fa-check-circle mr-1"></i> Aktif Terbit
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="{{ route('cbt.exams.results', $e->id) }}" class="btn btn-sm text-white font-weight-bold px-3 py-1 shadow-sm" style="background: linear-gradient(135deg, #851624, #5a0c16); border-radius: 8px;" title="Lihat Hasil Nilai Siswa">
                                            <i class="fas fa-chart-bar mr-1"></i> Nilai Siswa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-clipboard-list mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mb-0">Belum ada paket ujian CBT yang dibuat. Klik tombol <strong>"Buat Paket Ujian Baru"</strong> di atas!</p>
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
