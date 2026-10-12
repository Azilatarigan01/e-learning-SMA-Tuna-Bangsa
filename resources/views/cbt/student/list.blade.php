@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-graduation-cap mr-1"></i> Asesmen Online Mandiri
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Ruang Ujian & Kuis CBT Siswa
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Uji pemahaman Anda melalui sistem Computer-Based Testing (CBT) interaktif dengan penilaian otomatis dan timer waktu real-time.
                        </p>
                    </div>
                </div>
            </div>

            @include('_message')
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <div class="row">
                @forelse($exams as $e)
                @php
                    $attempt = $myAttempts->get($e->id);
                @endphp
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm rounded-14 h-100" style="border-radius: 14px; background: #fff; border-top: 4px solid {{ $attempt && $attempt->status == 'submitted' ? '#28a745' : '#851624' }};">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2; color: #851624; border: 1px solid #fed7d7; border-radius: 12px; font-size: 0.8rem;">
                                    <i class="fas fa-book mr-1"></i> {{ $e->subject->name ?? 'Mata Pelajaran' }}
                                </span>
                                @if($attempt && $attempt->status == 'submitted')
                                    <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 12px; font-size: 0.8rem;">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai Dikerjakan
                                    </span>
                                @else
                                    <span class="badge badge-warning text-dark px-3 py-1 font-weight-bold" style="background: #fdf2d2; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="far fa-clock mr-1"></i> Belum Dikerjakan
                                    </span>
                                @endif
                            </div>

                            <h5 class="font-weight-bold text-dark mb-2" style="line-height: 1.4;">
                                {{ $e->title }}
                            </h5>
                            <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                                {{ $e->instructions }}
                            </p>

                            <div class="row pt-3 border-top mb-4">
                                <div class="col-4 text-center border-right">
                                    <small class="text-muted d-block font-weight-bold">DURASI</small>
                                    <span class="font-weight-bold text-dark">{{ $e->duration_minutes }} Menit</span>
                                </div>
                                <div class="col-4 text-center border-right">
                                    <small class="text-muted d-block font-weight-bold">JUMLAH SOAL</small>
                                    <span class="font-weight-bold text-dark">{{ count($e->examQuestions) }} Butir</span>
                                </div>
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block font-weight-bold">KKM</small>
                                    <span class="font-weight-bold text-dark">{{ $e->passing_grade }}</span>
                                </div>
                            </div>

                            @if($attempt && $attempt->status == 'submitted')
                                <div class="d-flex align-items-center justify-content-between p-3 rounded mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                                    <div>
                                        <small class="text-muted d-block">Perolehan Nilai:</small>
                                        <strong class="h5 mb-0 font-weight-bold text-success">{{ $attempt->total_score }} / 100</strong>
                                    </div>
                                    <div>
                                        @if($attempt->total_score >= $e->passing_grade)
                                            <span class="badge badge-success px-2 py-1 font-weight-bold"><i class="fas fa-check mr-1"></i> TUNTAS KKM</span>
                                        @else
                                            <span class="badge badge-danger px-2 py-1 font-weight-bold"><i class="fas fa-redo mr-1"></i> REMEDIAL</span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('cbt.student.result', $attempt->id) }}" class="btn btn-outline-secondary font-weight-bold py-2 btn-block" style="border-radius: 10px;">
                                    <i class="fas fa-chart-pie mr-1"></i> Lihat Rincian Hasil Nilai
                                </a>
                            @else
                                <a href="{{ route('cbt.student.start', $e->id) }}" class="btn text-white font-weight-bold py-2 btn-block shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 10px; border: none;">
                                    <i class="fas fa-play-circle mr-1"></i> Mulai Mengerjakan Ujian
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-14 text-center py-5" style="border-radius: 14px; background: #fff;">
                        <div class="card-body">
                            <i class="fas fa-tasks text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="font-weight-bold text-dark">Tidak Ada Jadwal Ujian Aktif</h5>
                            <p class="text-muted max-w-500 mx-auto" style="max-width: 450px;">
                                Saat ini belum ada kuis atau ujian CBT yang dijadwalkan untuk kelas Anda. Silakan periksa kembali nanti.
                            </p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
