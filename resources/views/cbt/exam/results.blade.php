@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-chart-line mr-1"></i> Rekapitulasi Hasil Asesmen
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            {{ $exam->title }}
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Kelas: <strong>{{ $exam->classModel->name ?? '-' }}</strong> &bull; Mapel: <strong>{{ $exam->subject->name ?? '-' }}</strong> &bull; Standar KKM: <strong>{{ $exam->passing_grade }}</strong>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.exams.list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
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
            <!-- Metric Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-14 p-3 text-center" style="border-radius: 14px; background: #fff;">
                        <span class="text-muted small font-weight-bold">Total Siswa Telah Mengerjakan</span>
                        <h3 class="font-weight-bold text-dark mt-2 mb-0">{{ count($attempts) }} Siswa</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-14 p-3 text-center" style="border-radius: 14px; background: #fff;">
                        <span class="text-muted small font-weight-bold">Rata-Rata Nilai CBT</span>
                        @php
                            $avg = count($attempts) > 0 ? round($attempts->avg('total_score'), 1) : 0;
                        @endphp
                        <h3 class="font-weight-bold text-dark mt-2 mb-0" style="color: #851624 !important;">{{ $avg }} / 100</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-14 p-3 text-center" style="border-radius: 14px; background: #fff;">
                        <span class="text-muted small font-weight-bold">Tingkat Kelulusan KKM</span>
                        @php
                            $passedCount = $attempts->where('total_score', '>=', $exam->passing_grade)->count();
                            $passRate = count($attempts) > 0 ? round(($passedCount / count($attempts)) * 100, 1) : 0;
                        @endphp
                        <h3 class="font-weight-bold text-success mt-2 mb-0">{{ $passRate }}%</h3>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff; overflow: hidden;">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-medal mr-2 text-warning"></i> Peringkat & Perolehan Nilai Siswa
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">Rank</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Nama Lengkap Siswa</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Waktu Mulai</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Waktu Selesai</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Benar / Salah</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Skor Akhir</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-center">Status KKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attempts as $att)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold">
                                        @if($loop->iteration == 1)
                                            <span class="badge badge-warning text-dark font-weight-bold px-2 py-1"><i class="fas fa-crown mr-1"></i> #1</span>
                                        @elseif($loop->iteration == 2)
                                            <span class="badge badge-secondary px-2 py-1">#2</span>
                                        @elseif($loop->iteration == 3)
                                            <span class="badge badge-light border px-2 py-1">#3</span>
                                        @else
                                            <span class="text-muted ml-2">#{{ $loop->iteration }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="font-weight-bold text-dark">{{ $att->student->name ?? 'Siswa' }}</div>
                                        <small class="text-muted">{{ $att->student->email ?? '' }}</small>
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        {{ date('H:i:s', strtotime($att->started_at)) }}
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        {{ $att->submitted_at ? date('H:i:s', strtotime($att->submitted_at)) : '-' }}
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="text-success font-weight-bold">{{ $att->correct_count }} Benar</span> / 
                                        <span class="text-danger font-weight-bold">{{ $att->wrong_count }} Salah</span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="font-weight-bold fs-6" style="color: #851624; font-size: 1.15rem;">
                                            {{ $att->total_score }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($att->total_score >= $exam->passing_grade)
                                            <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 12px; font-size: 0.8rem;">
                                                <i class="fas fa-check-circle mr-1"></i> LULUS KKM
                                            </span>
                                        @else
                                            <span class="badge badge-danger px-3 py-1 font-weight-bold" style="border-radius: 12px; font-size: 0.8rem; background: #dc3545;">
                                                <i class="fas fa-exclamation-circle mr-1"></i> REMEDIAL
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-clock mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mb-0">Belum ada siswa yang mengumpulkan pengerjaan ujian ini.</p>
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
