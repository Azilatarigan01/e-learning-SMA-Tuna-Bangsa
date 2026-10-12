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
                            <i class="fas fa-edit mr-1"></i> Input Butir Soal Baru
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Tambah Soal Bank Soal CBT
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Lengkapi pertanyaan, pilihan ganda A s.d. E, dan tentukan kunci jawaban resmi.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.questions.list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
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
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('cbt.questions.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Mata Pelajaran <span class="text-danger">*</span></label>
                                <select name="subject_id" class="form-control" required style="border-radius: 8px;">
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach($subjects as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold small text-muted">Tingkat / Kelas (Opsional)</label>
                                <select name="class_id" class="form-control" style="border-radius: 8px;">
                                    <option value="">-- Umum / Semua Kelas --</option>
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold small text-muted">Bobot Poin Soal <span class="text-danger">*</span></label>
                                <input type="number" name="marks" class="form-control" value="10" min="1" max="100" required style="border-radius: 8px;">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold small text-muted">Teks Pertanyaan / Soal <span class="text-danger">*</span></label>
                            <textarea name="question_text" rows="4" class="form-control" placeholder="Tuliskan butir soal atau narasi permasalahan di sini..." required style="border-radius: 8px;"></textarea>
                        </div>

                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-list-check mr-1" style="color: #851624;"></i> Opsi Jawaban Pilihan Ganda
                        </h6>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Pilihan A <span class="text-danger">*</span></label>
                                <input type="text" name="option_a" class="form-control" placeholder="Jawaban A..." required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Pilihan B <span class="text-danger">*</span></label>
                                <input type="text" name="option_b" class="form-control" placeholder="Jawaban B..." required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Pilihan C <span class="text-danger">*</span></label>
                                <input type="text" name="option_c" class="form-control" placeholder="Jawaban C..." required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Pilihan D <span class="text-danger">*</span></label>
                                <input type="text" name="option_d" class="form-control" placeholder="Jawaban D..." required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Pilihan E <span class="text-danger">*</span></label>
                                <input type="text" name="option_e" class="form-control" placeholder="Jawaban E..." required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-danger">Kunci Jawaban Benar <span class="text-danger">*</span></label>
                                <select name="correct_answer" class="form-control font-weight-bold text-success border-success" required style="border-radius: 8px;">
                                    <option value="">-- Pilih Kunci Jawaban --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold small text-muted">Pembahasan Soal (Opsional)</label>
                            <textarea name="explanation" rows="2" class="form-control" placeholder="Penjelasan atau langkah rumus penyelesaian soal..." style="border-radius: 8px;"></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> Simpan ke Bank Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
