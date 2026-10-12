@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-file-circle-question"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-database mr-1"></i> Asesmen & Evaluasi CBT
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Bank Soal Ujian & Kuis Interaktif
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Pusat perbendaharaan butir soal pilihan ganda SMA Tuna Bangsa terstandar kurikulum dengan kunci jawaban dan bobot nilai.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('cbt.questions.add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Soal Baru
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
            <!-- Filter Bar -->
            <div class="card border-0 shadow-sm rounded-14 mb-4" style="border-radius: 14px; background: #fff;">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('cbt.questions.list') }}" class="form-row align-items-center">
                        <div class="col-md-5 mb-2 mb-md-0">
                            <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-book mr-1"></i> Filter Mata Pelajaran</label>
                            <select name="subject_id" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                <option value="">-- Semua Mata Pelajaran --</option>
                                @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" {{ $subjectId == $s->id ? 'selected' : '' }}>
                                        {{ $s->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-2 mb-md-0">
                            <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-chalkboard mr-1"></i> Filter Tingkat / Kelas</label>
                            <select name="class_id" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                <option value="">-- Semua Kelas --</option>
                                @foreach($classes as $c)
                                    <option value="{{ $c->id }}" {{ $classId == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 text-right pt-md-3">
                            <a href="{{ route('cbt.questions.list') }}" class="btn btn-sm btn-outline-secondary btn-block font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-redo-alt mr-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Question Cards -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-list-ol mr-2" style="color: #851624;"></i> Daftar Butir Soal Terdaftar 
                    <span class="badge badge-light border ml-1 font-weight-normal text-muted">{{ count($questions) }} Soal</span>
                </h5>
            </div>

            @forelse($questions as $index => $q)
            <div class="card border-0 shadow-sm rounded-14 mb-3" style="border-radius: 14px; background: #fff; border-left: 5px solid #851624 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-danger px-3 py-1 mr-2" style="background: #851624; border-radius: 10px; font-size: 0.82rem;">
                                Soal #{{ $loop->iteration }}
                            </span>
                            <span class="badge badge-warning text-dark font-weight-bold px-2 py-1 mr-2" style="background: #fdf2d2; border-radius: 10px; font-size: 0.8rem;">
                                {{ $q->subject->name ?? 'Mapel Umum' }}
                            </span>
                            @if($q->classModel)
                            <span class="badge badge-secondary px-2 py-1" style="border-radius: 10px; font-size: 0.78rem;">
                                {{ $q->classModel->name }}
                            </span>
                            @endif
                        </div>
                        <div>
                            <span class="badge badge-light border px-2 py-1 text-muted mr-2" style="font-size: 0.8rem;">
                                Bobot: {{ $q->marks }} Poin
                            </span>
                            <a href="{{ route('cbt.questions.delete', $q->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')" style="border-radius: 6px; padding: 2px 8px;" title="Hapus Soal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Question Text -->
                    <h6 class="font-weight-bold text-dark my-3" style="line-height: 1.6; font-size: 1.02rem;">
                        {{ $q->question_text }}
                    </h6>

                    <!-- Options Grid -->
                    <div class="row pt-2 pb-2">
                        <div class="col-md-6 mb-2">
                            <div class="p-2 rounded {{ $q->correct_answer == 'A' ? 'bg-success text-white font-weight-bold' : 'bg-light text-dark' }}" style="border-radius: 8px; font-size: 0.9rem;">
                                <strong>A.</strong> {{ $q->option_a }}
                                @if($q->correct_answer == 'A') <i class="fas fa-check-circle ml-1 float-right mt-1"></i> @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-2 rounded {{ $q->correct_answer == 'B' ? 'bg-success text-white font-weight-bold' : 'bg-light text-dark' }}" style="border-radius: 8px; font-size: 0.9rem;">
                                <strong>B.</strong> {{ $q->option_b }}
                                @if($q->correct_answer == 'B') <i class="fas fa-check-circle ml-1 float-right mt-1"></i> @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-2 rounded {{ $q->correct_answer == 'C' ? 'bg-success text-white font-weight-bold' : 'bg-light text-dark' }}" style="border-radius: 8px; font-size: 0.9rem;">
                                <strong>C.</strong> {{ $q->option_c }}
                                @if($q->correct_answer == 'C') <i class="fas fa-check-circle ml-1 float-right mt-1"></i> @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-2 rounded {{ $q->correct_answer == 'D' ? 'bg-success text-white font-weight-bold' : 'bg-light text-dark' }}" style="border-radius: 8px; font-size: 0.9rem;">
                                <strong>D.</strong> {{ $q->option_d }}
                                @if($q->correct_answer == 'D') <i class="fas fa-check-circle ml-1 float-right mt-1"></i> @endif
                            </div>
                        </div>
                        @if($q->option_e)
                        <div class="col-md-6 mb-2">
                            <div class="p-2 rounded {{ $q->correct_answer == 'E' ? 'bg-success text-white font-weight-bold' : 'bg-light text-dark' }}" style="border-radius: 8px; font-size: 0.9rem;">
                                <strong>E.</strong> {{ $q->option_e }}
                                @if($q->correct_answer == 'E') <i class="fas fa-check-circle ml-1 float-right mt-1"></i> @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($q->explanation)
                    <div class="mt-2 p-2 rounded small" style="background: #fdfbf7; border-left: 3px solid #c59b27; color: #555;">
                        <i class="fas fa-lightbulb text-warning mr-1"></i> <strong>Pembahasan:</strong> {{ $q->explanation }}
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="card border-0 shadow-sm rounded-14 text-center py-5" style="border-radius: 14px; background: #fff;">
                <div class="card-body">
                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Soal pada Kriteria Ini</h5>
                    <p class="text-muted max-w-500 mx-auto" style="max-width: 450px;">
                        Silakan tambahkan butir soal baru atau reset filter pencarian Anda.
                    </p>
                    <a href="{{ route('cbt.questions.add') }}" class="btn text-white font-weight-bold px-4 py-2" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                        <i class="fas fa-plus mr-1"></i> Tambah Soal Sekarang
                    </a>
                </div>
            </div>
            @endforelse

        </div>
    </section>
</div>
@endsection
