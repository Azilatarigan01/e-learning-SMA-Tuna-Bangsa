@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-history"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-check-circle mr-1"></i> Arsip Tugas Mandiri
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Riwayat Pengumpulan Tugas Saya
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Catatan berkas, lampiran jawaban, dan waktu serah tugas yang telah Anda serahkan kepada guru mata pelajaran.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('student.homework.list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Tugas
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
                        <i class="fas fa-file-circle-check mr-2" style="color: #851624;"></i> Berkas Tugas yang Sudah Dikumpulkan
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($getRecord) }} Penyerahan
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">No</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Mata Pelajaran</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Tenggat Guru</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">File Jawaban Anda</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Catatan Jawaban</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Waktu Diserahkan</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-center" style="width: 140px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $value)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <div class="font-weight-bold text-dark">{{ $value->subject_name }}</div>
                                        <small class="text-muted">{{ $value->class_name }}</small>
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        {{ date('d M Y', strtotime($value->submission_date)) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        @if(!empty($value->getDocument()))
                                            <a href="{{ $value->getDocument() }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" download>
                                                <i class="fas fa-file-download mr-1"></i> Berkas Jawaban
                                            </a>
                                        @else
                                            <span class="text-muted small">Tidak ada berkas</span>
                                        @endif
                                    </td>
                                    <td class="py-3" style="max-width: 250px;">
                                        <span class="text-dark small" style="line-height: 1.4;">
                                            {{ Str::limit(strip_tags($value->description), 80) ?: '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        <i class="far fa-clock mr-1"></i> {{ date('d M Y, H:i', strtotime($value->created_at)) }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 12px; font-size: 0.8rem;">
                                            <i class="fas fa-check-circle mr-1"></i> Terkirim
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-history mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mb-0">Anda belum pernah mengumpulkan tugas.</p>
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
