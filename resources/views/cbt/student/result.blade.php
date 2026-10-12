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
                            <i class="fas fa-poll mr-1"></i> Lembar Hasil Penilaian Komputer
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Hasil Evaluasi Ujian: {{ $exam->title }}
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Mata Pelajaran: <strong>{{ $exam->subject->name ?? '-' }}</strong> &bull; Waktu Selesai: <strong>{{ date('d M Y, H:i:s', strtotime($attempt->submitted_at ?? $attempt->updated_at)) }}</strong>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.student.list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Ujian
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
            <!-- Score Card Hero -->
            <div class="card border-0 shadow-sm rounded-14 mb-4 text-center p-4" style="border-radius: 14px; background: #fff;">
                <div class="card-body">
                    <div class="mb-3">
                        @if($attempt->total_score >= $exam->passing_grade)
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white shadow-sm mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #28a745, #1e7e34); font-size: 2.5rem;">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2 class="font-weight-bold text-success mb-1">SELAMAT, ANDA TUNTAS KKM!</h2>
                            <p class="text-muted mb-0">Capaian nilai Anda telah memenuhi kriteria ketuntasan minimal sekolah (KKM: {{ $exam->passing_grade }}).</p>
                        @else
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white shadow-sm mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #dc3545, #bd2130); font-size: 2.5rem;">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            <h2 class="font-weight-bold text-danger mb-1">PERLU TINDAK LANJUT / REMEDIAL</h2>
                            <p class="text-muted mb-0">Perolehan nilai Anda masih di bawah standar KKM ({{ $exam->passing_grade }}). Silakan hubungi guru mata pelajaran.</p>
                        @endif
                    </div>

                    <div class="d-inline-block px-5 py-3 rounded-14 my-3" style="background: #fdfbf7; border: 2px dashed #c59b27; border-radius: 14px;">
                        <span class="text-muted small font-weight-bold d-block text-uppercase">SKOR AKHIR CBT</span>
                        <h1 class="display-3 font-weight-bold mb-0" style="color: #851624;">
                            {{ $attempt->total_score }}
                        </h1>
                        <span class="text-muted small">dari skala maksimal 100</span>
                    </div>

                    <div class="row max-w-600 mx-auto mt-4 pt-3 border-top" style="max-width: 500px;">
                        <div class="col-6 text-center border-right">
                            <span class="text-success h4 font-weight-bold d-block mb-0">{{ $attempt->correct_count }}</span>
                            <small class="text-muted font-weight-bold">JAWABAN BENAR</small>
                        </div>
                        <div class="col-6 text-center">
                            <span class="text-danger h4 font-weight-bold d-block mb-0">{{ $attempt->wrong_count }}</span>
                            <small class="text-muted font-weight-bold">JAWABAN SALAH</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Breakdown Card -->
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-list-check mr-2" style="color: #851624;"></i> Rincian Pembahasan Jawaban
                    </h5>
                </div>
                <div class="card-body px-4 py-2">
                    @forelse($attempt->answers as $index => $ans)
                    <div class="p-3 mb-3 rounded-14 border {{ $ans->is_correct ? 'border-success' : 'border-danger' }}" style="border-radius: 12px; background: {{ $ans->is_correct ? '#f4faf6' : '#fdf7f7' }};">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge {{ $ans->is_correct ? 'badge-success' : 'badge-danger' }} px-3 py-1 font-weight-bold" style="border-radius: 10px;">
                                Soal #{{ $loop->iteration }} &bull; {{ $ans->is_correct ? 'Jawaban Benar' : 'Jawaban Salah' }}
                            </span>
                            <span class="text-muted small font-weight-bold">Poin: {{ $ans->score_awarded }}</span>
                        </div>

                        <p class="font-weight-bold text-dark mb-2" style="font-size: 0.95rem;">
                            {{ $ans->question->question_text ?? 'Soal tidak ditemukan' }}
                        </p>

                        <div class="small mb-2">
                            <span class="mr-3">Jawaban Anda: <strong class="{{ $ans->is_correct ? 'text-success' : 'text-danger' }}">{{ $ans->student_answer ?: 'Tidak Dijawab' }}</strong></span>
                            <span>Kunci Jawaban Resmi: <strong class="text-success">{{ $ans->question->correct_answer ?? '-' }}</strong></span>
                        </div>

                        @if(!empty($ans->question->explanation))
                        <div class="p-2 rounded bg-white small border text-muted">
                            <i class="fas fa-lightbulb text-warning mr-1"></i> <strong>Pembahasan:</strong> {{ $ans->question->explanation }}
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <p class="mb-0">Tidak ada rincian jawaban tersimpan.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
