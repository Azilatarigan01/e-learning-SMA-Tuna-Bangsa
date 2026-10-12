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
                            <i class="fas fa-plus-circle mr-1"></i> Penjadwalan Asesmen CBT
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Buat Paket Ujian & Kuis CBT Baru
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Tentukan rombel kelas sasaran, durasi pengerjaan, KKM, dan centang butir soal dari bank soal sekolah.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.exams.list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            @include('_message')
        </div>
    </div>

    <!-- Main Content Form -->
    <section class="content">
        <div class="container-fluid pb-5">
            <form method="POST" action="{{ route('cbt.exams.store') }}">
                @csrf
                <div class="row">
                    <!-- Left: Metadata Ujian -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-14 mb-4" style="border-radius: 14px; background: #fff;">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                                <h5 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-sliders-h mr-2" style="color: #851624;"></i> Konfigurasi Ujian
                                </h5>
                            </div>
                            <div class="card-body px-4 py-3">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Judul / Nama Paket Ujian <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Cth: Penilaian Harian 1 - Dinamika Gerak" required style="border-radius: 8px;">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Target Kelas Rombel <span class="text-danger">*</span></label>
                                    <select name="class_id" class="form-control" required style="border-radius: 8px;">
                                        <option value="">-- Pilih Kelas Sasaran --</option>
                                        @foreach($classes as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <select name="subject_id" class="form-control" required style="border-radius: 8px;">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach($subjects as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label class="font-weight-bold small text-muted mb-1">Durasi (Menit) <span class="text-danger">*</span></label>
                                        <input type="number" name="duration_minutes" class="form-control" value="60" min="5" max="240" required style="border-radius: 8px;">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="font-weight-bold small text-muted mb-1">Standar KKM <span class="text-danger">*</span></label>
                                        <input type="number" name="passing_grade" class="form-control" value="75" min="0" max="100" required style="border-radius: 8px;">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted mb-1">Petunjuk Pengerjaan</label>
                                    <textarea name="instructions" rows="3" class="form-control" style="border-radius: 8px;">Bacalah doa sebelum mengerjakan. Pilihlah satu jawaban yang paling tepat. Waktu pengerjaan berjalan otomatis.</textarea>
                                </div>

                                <button type="submit" class="btn btn-block text-white font-weight-bold py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 10px; border: none;">
                                    <i class="fas fa-paper-plane mr-1"></i> Terbitkan Ujian CBT Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Pilih Soal dari Bank Soal -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-0">
                                        <i class="fas fa-check-double mr-2 text-warning"></i> Pilih Soal dari Bank Soal
                                    </h5>
                                    <small class="text-muted">Centang butir soal yang ingin dimasukkan ke dalam paket ujian ini.</small>
                                </div>
                            </div>
                            <div class="card-body px-4 py-3" style="max-height: 600px; overflow-y: auto;">
                                @forelse($questions as $q)
                                <div class="p-3 mb-3 rounded-14 border" style="border-radius: 12px; background: #fdfbf7;">
                                    <div class="form-check d-flex align-items-start">
                                        <input class="form-check-input mt-1 mr-3" type="checkbox" name="question_ids[]" value="{{ $q->id }}" id="qCheck{{ $q->id }}" checked>
                                        <label class="form-check-label w-100" for="qCheck{{ $q->id }}" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="badge badge-danger px-2 py-0" style="background: #851624; font-size: 0.72rem;">{{ $q->subject->name ?? 'Mapel' }}</span>
                                                <span class="badge badge-light border text-muted px-2 py-0" style="font-size: 0.72rem;">Bobot: {{ $q->marks }} Poin</span>
                                            </div>
                                            <p class="font-weight-bold text-dark mb-2" style="font-size: 0.92rem; line-height: 1.5;">
                                                {{ $q->question_text }}
                                            </p>
                                            <div class="small text-muted">
                                                <span class="mr-2">A. {{ Str::limit($q->option_a, 25) }}</span>
                                                <span class="mr-2">B. {{ Str::limit($q->option_b, 25) }}</span>
                                                <span class="font-weight-bold text-success">&bull; Kunci: {{ $q->correct_answer }}</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-exclamation-circle mb-2" style="font-size: 2.5rem; opacity: 0.4;"></i>
                                    <p>Belum ada soal di Bank Soal. Silakan buat soal terlebih dahulu di menu <strong>Bank Soal CBT</strong>.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
